<?php

namespace App\Services;

use App\EventType;
use App\Models\Event;
use App\Models\Fixture;
use App\Models\Group;
use App\Models\Standing;
use App\Models\TeamEvent;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FixtureService
{
    /**
     * Create a new class instance.
     */
    public function listTeamEventDummy()
    {
        return [
            [
                'match_id' => 1,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 1,
                            'player1' => ['id' => 1, 'name' => 'Player 1'],
                            'player2' => ['id' => 2, 'name' => 'Player 2'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 2,
                            'player1' => ['id' => 3, 'name' => 'Player 3'],
                            'player2' => ['id' => 4, 'name' => 'Player 4'],
                        ],
                    ],
                ],
            ],
            [
                'match_id' => 2,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 3,
                            'player1' => ['id' => 5, 'name' => 'Player 5'],
                            'player2' => ['id' => 6, 'name' => 'Player 6'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 4,
                            'player1' => ['id' => 7, 'name' => 'Player 7'],
                            'player2' => ['id' => 8, 'name' => 'Player 8'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 3,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 5,
                            'player1' => ['id' => 9, 'name' => 'Player 9'],
                            'player2' => ['id' => 10, 'name' => 'Player 10'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 6,
                            'player1' => ['id' => 11, 'name' => 'Player 11'],
                            'player2' => ['id' => 12, 'name' => 'Player 12'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 4,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 7,
                            'player1' => ['id' => 13, 'name' => 'Player 13'],
                            'player2' => ['id' => 14, 'name' => 'Player 14'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 8,
                            'player1' => ['id' => 15, 'name' => 'Player 15'],
                            'player2' => ['id' => 16, 'name' => 'Player 16'],
                        ]
                    ],
                ],
            ],

            // ================= MATCH 5 – 16 =================

            [
                'match_id' => 5,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 9,
                            'player1' => ['id' => 17, 'name' => 'Player 17'],
                            'player2' => ['id' => 18, 'name' => 'Player 18'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 10,
                            'player1' => ['id' => 19, 'name' => 'Player 19'],
                            'player2' => ['id' => 20, 'name' => 'Player 20'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 6,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 11,
                            'player1' => ['id' => 21, 'name' => 'Player 21'],
                            'player2' => ['id' => 22, 'name' => 'Player 22'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 12,
                            'player1' => ['id' => 23, 'name' => 'Player 23'],
                            'player2' => ['id' => 24, 'name' => 'Player 24'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 7,
                'teams' => [

                    [
                        'side' => 1,
                        'team' => [
                            'id' => 13,
                            'player1' => ['id' => 25, 'name' => 'Player 25'],
                            'player2' => ['id' => 26, 'name' => 'Player 26'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 14,
                            'player1' => ['id' => 27, 'name' => 'Player 27'],
                            'player2' => ['id' => 28, 'name' => 'Player 28'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 8,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 15,
                            'player1' => ['id' => 29, 'name' => 'Player 29'],
                            'player2' => ['id' => 30, 'name' => 'Player 30'],
                        ]

                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 16,
                            'player1' => ['id' => 31, 'name' => 'Player 31'],
                            'player2' => ['id' => 32, 'name' => 'Player 32'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 9,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 17,
                            'player1' => ['id' => 33, 'name' => 'Player 33'],
                            'player2' => ['id' => 34, 'name' => 'Player 34'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 18,
                            'player1' => ['id' => 35, 'name' => 'Player 35'],
                            'player2' => ['id' => 36, 'name' => 'Player 36'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 10,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 19,
                            'player1' => ['id' => 37, 'name' => 'Player 37'],
                            'player2' => ['id' => 38, 'name' => 'Player 38'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 20,
                            'player1' => ['id' => 39, 'name' => 'Player 39'],
                            'player2' => ['id' => 40, 'name' => 'Player 40'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 11,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 21,
                            'player1' => ['id' => 41, 'name' => 'Player 41'],
                            'player2' => ['id' => 42, 'name' => 'Player 42'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 22,
                            'player1' => ['id' => 43, 'name' => 'Player 43'],
                            'player2' => ['id' => 44, 'name' => 'Player 44'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 12,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 23,
                            'player1' => ['id' => 45, 'name' => 'Player 45'],
                            'player2' => ['id' => 46, 'name' => 'Player 46'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 24,
                            'player1' => ['id' => 47, 'name' => 'Player 47'],
                            'player2' => ['id' => 48, 'name' => 'Player 48'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 13,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 25,
                            'player1' => ['id' => 49, 'name' => 'Player 49'],
                            'player2' => ['id' => 50, 'name' => 'Player 50'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 26,
                            'player1' => ['id' => 51, 'name' => 'Player 51'],
                            'player2' => ['id' => 52, 'name' => 'Player 52'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 14,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 27,
                            'player1' => ['id' => 53, 'name' => 'Player 53'],
                            'player2' => ['id' => 54, 'name' => 'Player 54'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 28,
                            'player1' => ['id' => 55, 'name' => 'Player 55'],
                            'player2' => ['id' => 56, 'name' => 'Player 56'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 15,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 29,
                            'player1' => ['id' => 57, 'name' => 'Player 57'],
                            'player2' => ['id' => 58, 'name' => 'Player 58'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 30,
                            'player1' => ['id' => 59, 'name' => 'Player 59'],
                            'player2' => ['id' => 60, 'name' => 'Player 60'],
                        ]
                    ],
                ],
            ],
            [
                'match_id' => 16,
                'teams' => [
                    [
                        'side' => 1,
                        'team' => [
                            'id' => 31,
                            'player1' => ['id' => 61, 'name' => 'Player 61'],
                            'player2' => ['id' => 62, 'name' => 'Player 62'],
                        ]
                    ],
                    [
                        'side' => 2,
                        'team' => [
                            'id' => 32,
                            'player1' => ['id' => 63, 'name' => 'Player 63'],
                            'player2' => ['id' => 64, 'name' => 'Player 64'],
                        ]
                    ],
                ],
            ],
        ];
    }
    /**
     * ENTRY POINT
     */
    public function generate(Event $event): void
    {
        match ($event->event_type) {
            'league'        => $this->generateLeague($event),
            'championship'           => $this->generateCup($event),
            'league_and_championship'  => $this->generateChampionship($event),
        };
    }

    /**
     * =====================
     * LIGA (ROUND ROBIN)
     * =====================
     */
    public function generateLeague(Event $event): void
    {
        $teams = $this->getTournamentTeams($event);

        DB::transaction(function () use ($event, $teams) {
            foreach ($teams as $i => $teamA) {
                for ($j = $i + 1; $j < count($teams); $j++) {
                    $teamB = $teams[$j];
                    Fixture::create([
                        'event_id' => $event->id,
                        'event_type' => EventType::LEAGUE,
                        'first_team_id'     => $teamA->id,
                        'second_team_id'     => $teamB->id,
                    ]);
                }
            }

            $this->initStandings($event, $teams);
        });
    }

    /**
     * =====================
     * CUP (KNOCKOUT)
     * =====================
     */
    public function generateCup(Event $event): void
    {
        try {
            //code...
            $teams = $this->getTournamentTeams($event);
            $pairings = $this->seededPairing($teams);
            foreach ($pairings as [$teamA, $teamB]) {
                Fixture::create([
                    'event_id' => $event->id,
                    'event_type' => EventType::CHAMPIONSHIP,
                    'round_name' => $this->initialRoundName(count($pairings) * 2),
                    'first_team_id' => $teamA->id,
                    'second_team_id' => $teamB->id,
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * =====================
     * CHAMPIONSHIP
     * =====================
     */
    public function generateChampionship(Event $event): void
    {
        $teams = $this->getTournamentTeams($event);

        DB::transaction(function () use ($event, $teams) {
            $groups = $this->createGroups($event, $teams);

            $this->generateGroupMatches($event, $groups);

            $this->initStandings($event, $teams, true);
        });
    }

    /**
     * =====================
     * GROUP MATCHES
     * =====================
     */
    protected function generateGroupMatches(Event $event, Collection $groups): void
    {
        foreach ($groups as $group) {
            $teams = $group->teams;

            for ($i = 0; $i < $teams->count(); $i++) {
                for ($j = $i + 1; $j < $teams->count(); $j++) {
                    Fixture::create([
                        'event_id' => $event->id,
                        'stage'         => EventType::LEAGUE_AND_CHAMPIONSHIP,
                        'group_id'      => $group->id,
                        'first_team_id'     => $teams[$i]->id,
                        'second_team_id'     => $teams[$j]->id,
                    ]);
                }
            }
        }
    }

    /**
     * =====================
     * SEEDING & PAIRING
     * =====================
     */
    protected function seededPairing(Collection $teams): array
    {
        $sorted = $teams->sortBy(fn($t) => $t->seed ?? 999)->values();

        $pairings = [];
        $left = 0;
        $right = $sorted->count() - 1;

        while ($left < $right) {
            $pairings[] = [$sorted[$left], $sorted[$right]];
            $left++;
            $right--;
        }

        return $pairings;
    }

    /**
     * =====================
     * GROUP DISTRIBUTION
     * =====================
     */
    protected function createGroups(Event $event, Collection $teams): Collection
    {
        $groupNames = range('A', 'Z');
        $groupCount = ceil($teams->count() / 4);

        $groups = collect();

        for ($i = 0; $i < $groupCount; $i++) {
            $groups->push(
                Group::create([
                    'event_id' => $event->id,
                    'name' => $groupNames[$i],
                ])
            );
        }

        $sorted = $teams->sortBy(fn($t) => $t->seed ?? 999)->values();

        $i = 0;
        foreach ($sorted as $team) {
            $group = $groups[$i % $groupCount];
            $group->teams()->attach($team->id);
            $i++;
        }

        return $groups->load('teams');
    }

    /**
     * =====================
     * STANDING INIT
     * =====================
     */
    protected function initStandings(Event $event, Collection $teams, bool $withGroup = false): void
    {
        foreach ($teams as $team) {
            Standing::create([
                'event_id' => $event->id,
                'team_event_id' => $team->team_event_id,
            ]);
        }
    }

    /**
     * =====================
     * HELPERS
     * =====================
     */
    protected function getTournamentTeams(Event $event): Collection
    {
        return TeamEvent::where('event_id', $event->id)
            ->get();
    }

    protected function initialRoundName(int $teamCount): string
    {
        return match ($teamCount) {
            16 => 'Round of 16',
            8  => 'Quarter Final',
            4  => 'Semi Final',
            2  => 'Final',
            default => 'Knockout Round',
        };
    }
}
