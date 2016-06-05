for i in {1..50}
do
    eval date
    eval 'php artisan schedule:run'
    sleep 1m
done
