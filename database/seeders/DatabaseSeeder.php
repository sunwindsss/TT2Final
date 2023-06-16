<?php

namespace Database\Seeders;

use App\Models\TVShow;
use App\Models\Actor;
use App\Models\ActorsInShows;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tvShowsData = [
            [
                'name' => 'Breaking Bad',
                'description' => 'A high school chemistry teacher turned methamphetamine kingpin.',
                'fixed_score' => 9.5,
                'picture' => 'tv_shows/breaking_bad.png',
                'actors' => [
                    [
                        'full_name' => 'Bryan Cranston',
                        'age' => 65,
                        'biography' => 'Bryan Lee Cranston is an American actor, director, and producer.',
                    ],
                    [
                        'full_name' => 'Aaron Paul',
                        'age' => 42,
                        'biography' => 'Aaron Paul Sturtevant is an American actor and producer.',
                    ],
                ],
            ],
            [
                'name' => 'Game of Thrones',
                'description' => 'Nine noble families wage war for control over the lands of Westeros.',
                'fixed_score' => 9.3,
                'picture' => 'tv_shows/game_of_thrones.png',
                'actors' => [
                    [
                        'full_name' => 'Peter Dinklage',
                        'age' => 52,
                        'biography' => 'Peter Hayden Dinklage is an American actor.',
                    ],
                    [
                        'full_name' => 'Emilia Clarke',
                        'age' => 34,
                        'biography' => 'Emilia Isobel Euphemia Rose Clarke is an English actress.',
                    ],
                ],
            ],
            [
                'name' => 'Chernobyl',
                'description' => 'The Chernobyl nuclear disaster and its aftermath.',
                'fixed_score' => 9.4,
                'picture' => 'tv_shows/chernobyl.png',
                'actors' => [
                    [
                        'full_name' => 'Jared Harris',
                        'age' => 59,
                        'biography' => 'Jared Francis Harris is an English actor.',
                    ],
                    [
                        'full_name' => 'Stellan Skarsgård',
                        'age' => 70,
                        'biography' => 'Stellan John Skarsgård is a Swedish actor.',
                    ],
                ],
            ],
            [
                'name' => 'The Sopranos',
                'description' => 'New Jersey mob boss Tony Soprano juggles the problems of his personal life.',
                'fixed_score' => 9.2,
                'picture' => 'tv_shows/the_sopranos.png',
                'actors' => [
                    [
                        'full_name' => 'James Gandolfini',
                        'age' => 51,
                        'biography' => 'James Joseph Gandolfini Jr. was an American actor.',
                    ],
                    [
                        'full_name' => 'Edie Falco',
                        'age' => 58,
                        'biography' => 'Edith Falco is an American actress.',
                    ],
                ],
            ],
            [
                'name' => 'Better Call Saul',
                'description' => 'The trials and tribulations of criminal lawyer Jimmy McGill in the time before he established his strip-mall law office in Albuquerque, New Mexico.',
                'fixed_score' => 8.7,
                'picture' => 'tv_shows/better_call_saul.png',
                'actors' => [
                    [
                        'full_name' => 'Bob Odenkirk',
                        'age' => 59,
                        'biography' => 'Robert John Odenkirk is an American actor, comedian, writer, director, and producer.',
                    ],
                    [
                        'full_name' => 'Jonathan Banks',
                        'age' => 74,
                        'biography' => 'Jonathan Ray Banks is an American actor.',
                    ],
                ],
            ],
            [
                'name' => 'Friends',
                'description' => 'The misadventures of a group of friends as they navigate the pitfalls of work, life, and love in Manhattan.',
                'fixed_score' => 8.9,
                'picture' => 'tv_shows/friends.png',
                'actors' => [
                    [
                        'full_name' => 'Jennifer Aniston',
                        'age' => 52,
                        'biography' => 'Jennifer Joanna Aniston is an American actress, producer, and businesswoman.',
                    ],
                    [
                        'full_name' => 'Courteney Cox',
                        'age' => 57,
                        'biography' => 'Courteney Bass Cox is an American actress, producer, and director.',
                    ],
                ],
            ],
            [
                'name' => 'The Wire',
                'description' => 'The Baltimore drug scene, as seen through the eyes of drug dealers and law enforcement.',
                'fixed_score' => 9.3,
                'picture' => 'tv_shows/the_wire.png',
                'actors' => [
                    [
                        'full_name' => 'Dominic West',
                        'age' => 51,
                        'biography' => 'Dominic Gerard Francis Eagleton West is an English actor.',
                    ],
                    [
                        'full_name' => 'Idris Elba',
                        'age' => 49,
                        'biography' => 'Idrissa Akuna Elba OBE is an English actor, producer, and musician.',
                    ],
                ],
            ],
            [
                'name' => 'The Office',
                'description' => 'A mockumentary on a group of typical office workers, where the workday consists of ego clashes, inappropriate behavior, and tedium.',
                'fixed_score' => 8.9,
                'picture' => 'tv_shows/the_office.png',
                'actors' => [
                    [
                        'full_name' => 'Steve Carell',
                        'age' => 59,
                        'biography' => 'Steven John Carell is an American actor, comedian, writer, and director.',
                    ],
                    [
                        'full_name' => 'Rainn Wilson',
                        'age' => 55,
                        'biography' => 'Rainn Dietrich Wilson is an American actor, comedian, writer, and producer.',
                    ],
                ],
            ],
            [
                'name' => 'The World At War',
                'description' => 'A documentary series about World War II.',
                'fixed_score' => 9.2,
                'picture' => 'tv_shows/the_world_at_war.png',
                'actors' => [
                    [
                        'full_name' => 'Laurence Olivier',
                        'age' => 82,
                        'biography' => 'Laurence Kerr Olivier was an English actor and director.',
                    ],
                ],
            ],
            [
                'name' => 'Rick and Morty',
                'description' => 'An animated science fiction sitcom.',
                'fixed_score' => 9.3,
                'picture' => 'tv_shows/rick_and_morty.png',
                'actors' => [
                    [
                        'full_name' => 'Justin Roiland',
                        'age' => 41,
                        'biography' => 'Justin Roiland is an American actor, animator, writer, producer, and director.',
                    ],
                    [
                        'full_name' => 'Chris Parnell',
                        'age' => 55,
                        'biography' => 'Thomas Christopher Parnell is an American actor, voice artist, and comedian.',
                    ],
                ],
            ],
            [
                'name' => 'Sherlock',
                'description' => 'A modern-day adaptation of Sherlock Holmes stories.',
                'fixed_score' => 9.1,
                'picture' => 'tv_shows/sherlock.png',
                'actors' => [
                    [
                        'full_name' => 'Benedict Cumberbatch',
                        'age' => 45,
                        'biography' => 'Benedict Timothy Carlton Cumberbatch is an English actor.',
                    ],
                    [
                        'full_name' => 'Martin Freeman',
                        'age' => 50,
                        'biography' => 'Martin John Christopher Freeman is an English actor.',
                    ],
                ],
            ],
            [
                'name' => 'Seinfeld',
                'description' => 'A sitcom about a group of friends in New York City.',
                'fixed_score' => 8.8,
                'picture' => 'tv_shows/seinfeld.png',
                'actors' => [
                    [
                        'full_name' => 'Jerry Seinfeld',
                        'age' => 67,
                        'biography' => 'Jerome Allen Seinfeld is an American comedian, actor, writer, and producer.',
                    ],
                    [
                        'full_name' => 'Julia Louis-Dreyfus',
                        'age' => 61,
                        'biography' => 'Julia Scarlett Elizabeth Louis-Dreyfus is an American actress, comedian, and producer.',
                    ],
                ],
            ],
            [
                'name' => 'Succession',
                'description' => 'A drama series about a wealthy family grappling for control of their media and entertainment conglomerate.',
                'fixed_score' => 8.7,
                'picture' => 'tv_shows/succession.png',
                'actors' => [
                    [
                        'full_name' => 'Brian Cox',
                        'age' => 75,
                        'biography' => 'Brian Denis Cox is a Scottish actor.',
                    ],
                    [
                        'full_name' => 'Jeremy Strong',
                        'age' => 43,
                        'biography' => 'Jeremy Strong is an American actor.',
                    ],
                ],
            ],
            [
                'name' => 'The Walking Dead',
                'description' => 'A post-apocalyptic horror television series based on the comic book series.',
                'fixed_score' => 8.2,
                'picture' => 'tv_shows/the_walking_dead.png',
                'actors' => [
                    [
                        'full_name' => 'Andrew Lincoln',
                        'age' => 48,
                        'biography' => 'Andrew James Clutterbuck, known professionally as Andrew Lincoln, is an English actor.',
                    ],
                    [
                        'full_name' => 'Norman Reedus',
                        'age' => 53,
                        'biography' => 'Norman Mark Reedus is an American actor, television host, and model.',
                    ],
                ],
            ],
        ];

        foreach ($tvShowsData as $tvShowData) {
            $actorsData = $tvShowData['actors'];
            unset($tvShowData['actors']);

            $tvShow = TVShow::create($tvShowData);

            foreach ($actorsData as $actorData) {
                $actor = Actor::create($actorData);

                ActorsInShows::create([
                    'show_id' => $tvShow->id,
                    'actor_id' => $actor->id,
                ]);
            }
        }
    }
}