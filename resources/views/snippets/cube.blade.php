<div id="thecube-wrapper">
    <div id="thecube">
        <div class="scene">
            <div class="shape">
                <a class="modal-trigger" href="#cube-industries"><div class="face left">
                   <div class="face-content">Industries</div>
                </div></a>
                <a class="modal-trigger" href="#cube-domains"><div class="face right">
                    <div class="face-content">Applications</div>
                </div></a>
                <a class="modal-trigger" href="#cube-technologies"><div class="face top">
                    <div class="face-content">Technologies</div>
                </div></a>
                <div id="shadow1" class="face shadow"></div>
                <div id="shadow2" class="face shadow"></div>
                <div id="shadow3" class="face shadow"></div>
                <div id="shadow4" class="face shadow"></div>
            </div>
        </div>
    </div>
</div>

<div id="cube-technologies" class="modal bottom-sheet">
    <a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>
    <div class="modal-content container">
        <h2>Technologies</h2>
        <div class="row">
            <div class="col s6 l4">
                <h3>Emerging</h3>
                @foreach($categories['technologies']['emerging'] as $technology)
                    @if($technology->orgs()->first() != null)
                        <a href="/technology/{{ $technology->id }}">
                            {{ $technology->name }}
                        </a>
                    @else
                        {{ $technology->name }}
                    @endif <br />
                @endforeach
            </div>
            <div class="col s12 l4">
                <h3>Stable</h3>
                @foreach($categories['technologies']['stable'] as $technology)
                    @if($technology->orgs()->first() != null)
                        <a href="/technology/{{ $technology->id }}">
                            {{ $technology->name }}
                        </a>
                    @else
                        {{ $technology->name }}
                    @endif <br />
                @endforeach
            </div>
            <div class="col s12 l4">
                <h3>Accelerating</h3>
                @foreach($categories['technologies']['accelerating'] as $technology)
                    @if($technology->orgs()->first() != null)
                        <a href="/technology/{{ $technology->id }}">
                            {{ $technology->name }}
                        </a>
                    @else
                        {{ $technology->name }}
                    @endif <br />
                @endforeach
            </div>
        </div>
    </div>
</div>

<div id="cube-industries" class="modal bottom-sheet">
    <a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>
    <div class="modal-content container">
        <h2>Industries</h2>
        <div class="row">
            @foreach($categories['industries'] as $industries)
                <div class="col s12 l3">
                    @foreach($industries as $industry)
                        @if($industry->orgs()->first() != null)
                            <a href="/industry/{{ $industry->id }}">
                                {{ $industry->name }}
                            </a>
                        @else
                            {{ $industry->name }}
                        @endif<br />
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="cube-domains" class="modal bottom-sheet">
    <a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>
    <div class="modal-content container">
        <h2>Applications</h2>
        <div class="row">
            @foreach($categories['tags'] as $tags)
                <div class="col s6 l3">
                    @foreach($tags as $tag)
                        <a href="/tag/{{ $tag->id }}">
                            {{ $tag->name }}
                        </a><br />
                    @endforeach
                </div>
             @endforeach
        </div>
    </div>
</div>

<script type="text/javascript">
  $('#close-cube-technologies').click(function() {
    $('#cube-technologies').closeModal(); 
  });
  
  $('#close-cube-industries').click(function() {
    $('#cube-industries').closeModal(); 
  });
  
  $('#close-cube-domains').click(function() {
    $('#cube-domains').closeModal();  
  });    
</script>