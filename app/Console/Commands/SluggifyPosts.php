<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SluggifyPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sluggify-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            if (!$post->slug) {
                $slug = $this->createUniqueSlug($post->title);
                $post->slug = $slug;
                $post->save();
            }
        }

        $this->info('Slugs generated successfully.');
    }

    protected function createUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        while (Post::where('slug', $slug)->exists()) {
            $randomString = Str::random(6);
            $slug = "{$originalSlug}-{$randomString}";
        }

        return $slug;
    }
}
