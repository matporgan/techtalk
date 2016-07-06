<?php

use App\Discussion;

/**
 * Add http if not already present.
 *
 * @param  string $url
 * @return string
 */
function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/**
 * Get a 2D array of all the categories in the database.
 *
 * @return array
 */
function getCategories()
{
    // create array for each of the industry domains
    $industries = App\Industry::orderBy('position')->lists('name', 'id')->all();

    // for ($i=1; $i<=count($industries); $i++)
    // {
    //     $domains[$i] = App\Domain::where('industry_id', $i)->lists('name', 'id')->all();
    // }

    return [
        'technologies' => App\Technology::orderBy('position')->lists('name', 'id')->all(),
        'industries' => $industries,
        // 'domains' => $domains,
        'tags' => App\Tag::lists('name', 'id')->all()
    ];
}

/**
 * Gets an array of comment collections in the correct display order.
 *
 * @param  Discussion $discussion
 * @return array $comments
 */
function getOrderedComments(Discussion $discussion)
{
    // get list of comment and parent ids sorted by descending id; to have newest comments first
    $comment_parent_ids = $discussion->comments->sortByDesc('id')->lists('parent_id', 'id')->all();

    // check to ensure comments exist
    if(empty($comment_parent_ids))
        return null;

    // get id and parent_id arrays and order them
    $comment_ids = array_keys($comment_parent_ids);
    $parent_ids = array_values($comment_parent_ids);
    $ordered_ids = getOrderedParentChildList($comment_ids, $parent_ids);

    // get collections based off $ordered_ids
    static $comment;
    for($i=0; $i<count($discussion->comments); $i++)
    {
        if($i > 0)
        {
            $previous = $comment;
            $comment = $discussion->comments->where('id', $ordered_ids[$i][0])->first();
            $comment->setLevel($ordered_ids[$i][1]);
            $comment->setParentName($previous->user->getNameAndCity());
        }
        else
        {
            $comment = $discussion->comments->where('id', $ordered_ids[$i][0])->first();
            $comment->setLevel($ordered_ids[$i][1]);
        }
        $comments[] = $comment;
    }

    return $comments;
}

/**
 * Orders an array of ids based on an array of parent ids.
 * Also adds a 'level' attribute to each id for css indenting.
 * E.g. [ID]   [PID]     [ID,Level]
 *      [ 1]   [  -]     [  1,0   ]
 *      [ 2]   [  -]     [  3,1   ]
 *      [ 3]   [  1]     [  5,2   ]
 *      [ 4] & [  1]  => [  4,1   ]
 *      [ 5]   [  3]     [  8,2   ]
 *      [ 6]   [  1]     [  9,2   ]
 *      [ 7]   [  2]     [  6,1   ]
 *      [ 8]   [  4]     [  2,0   ]
 *      [ 9]   [  4]     [  7,1   ]
 *
 * @param  array $ids
 * @param  array $parent_ids
 * @param  array $ordered_ids = null
 * @param  int $position = 0
 * @return array $ordered_ids
 */
function getOrderedParentChildList($ids, $parent_ids, $ordered_ids = array(null), $position = null)
{
    static $level = 0; // indent level of id

    if(! empty($ids)) // if ids remain
    {

        // if null, look for the next root id
        if($position === null)
        {
            $position = array_search(null, $parent_ids);
        }

        // place $id at $position into ordered array
        $id = $ids[$position];
        $ordered_ids[] = [$id, $level];

        // remove ids from lists and re-key
        unset($ids[$position]);
        $ids = array_values($ids);
        unset($parent_ids[$position]);
        $parent_ids = array_values($parent_ids);

        // check if id has children
        $children = array_keys($parent_ids, $id);

        if(! empty($children)) // children found
        {
            // increase indent level
            $level++;

            // get ids of children
            foreach($children as $child)
            {
                $child_ids[] = $ids[$child];
            }

            foreach($child_ids as $child_id)
            {
                // get next child's position
                $next_pos = array_search($child_id, $ids);

                // call getOrderedParentChildList on that child
                $results = getOrderedParentChildList($ids, $parent_ids, $ordered_ids, $next_pos);

                // put results back into arrays
                $ids = $results[0];
                $parent_ids = $results[1];
                $ordered_ids = $results[2];
            }

            // no more children; reduce indent
            $level--;
        }

        if($level != 0)
        {
            // pass arrays back to parent
            return [$ids, $parent_ids, $ordered_ids];
        }
        else
        {
            // move on to next root id
            return getOrderedParentChildList($ids, $parent_ids, $ordered_ids);
        }
    }
    else // no more ids
    {
        array_shift($ordered_ids); // remove first null element
        return $ordered_ids;
    }
}
