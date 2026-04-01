<?php
namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            [
                'name' => 'League of Legends',
                'image' => 'https://cdn1.epicgames.com/offer/24b9b5e323bc40eea252a10cdd3b2f10/EGS_LeagueofLegends_RiotGames_S1_2560x1440-47eb328eac5ddd63ebd096ded7d0d5ab',
            ],
            [
                'name' => 'VALORANT',
                'image' => 'https://www.riotgames.com/darkroom/1440/d0807e131a84f2e42c7a303bda672789:3d02afa7e0bfb75f645d97467765b24c/valorant-offwhitelaunch-keyart.jpg',
            ],
            [
                'name' => 'Counter-Strike 2',
                'image' => 'https://gaming-cdn.com/images/products/13664/616x353/counter-strike-2-pc-game-steam-cover.jpg?v=1695885435',
            ],
            [
                'name' => 'EA SPORTS FC 26',
                'image' => 'https://gaming-cdn.com/images/news/articles/13774/cover/1000x563/ea-sports-fc-26-releases-on-september-26-cover68778afd733aa.jpg',
            ],
            [
                'name' => 'Free Fire',
                'image' => 'https://cdn-www.bluestacks.com/bs-images/Top-Free-Fire-Characters-of-2025-A-Comprehensive-Guide.png',
            ],
            [
                'name' => 'PUBG Mobile',
                'image' => 'https://static0.xdaimages.com/wordpress/wp-content/uploads/2018/06/pubg.jpg?w=1200&h=675&fit=crop',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}