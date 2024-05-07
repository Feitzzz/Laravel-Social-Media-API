<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
// use ;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    protected $model = Comment::class;

    public function definition(): array
    {

        // $isReply = fake()->boolean(30);

        // if ($isReply) {
        //     $post = Post::factory()->create(); // Create a post first
        //     // Create a parent comment for the post
        //     $parentComment = Comment::factory()->create([
        //         'post_id' => $post->id,
        //         'parent_id' => null // Meaning it is a parent comment
        //     ]);

        //     return [
        //         'content' => fake()->sentence,
        //         'parent_id' => $parentComment->id, // Uses the id of the parent comment
        //         'user_id' => \App\Models\User::factory(),
        //         'post_id' => $post->id, // Use the same post_id as the parent
        //     ];
        // } else {
        //     // Create a top-level comment for the post
        //     $post = Post::factory()->create(); // Create a post first
        //     return [
        //         'content' => fake()->sentence,
        //         'parent_id' => null,
        //         'user_id' => \App\Models\User::factory(),
        //         'post_id' => $post->id, // Use the generated post's id
        //     ];
        // }

        return [
            'content' => fake()->sentence,
            'user_id' => \App\Models\User::factory(),
            'post_id' => \App\Models\Post::factory()
        ];
    }
}
