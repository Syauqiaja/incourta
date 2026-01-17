@extends('admin.layouts.app-alpine')
@section('content')
    <!-- [ breadcrumb ] start -->
    {{ Breadcrumbs::render('admin.home.index') }}

    <!-- [ breadcrumb ] end -->


    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Hello card</h5>
                </div>
                <div class="card-body" x-data="matchmaking(@js($fixtures))" x-init="init()">
                    <div class="row g-3">
                        <template x-for="match in matches" :key="match.match_id">
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header text-center fw-bold">
                                        Match #<span x-text="match.match_id"></span>
                                    </div>

                                    <div class="card-body row">
                                        <!-- SIDE 1 -->
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small mb-1">Side 1</div>
                                            <div class="list-group team-drop" :data-match="match.match_id" data-side="1">
                                                <template x-for="item in match.teams.filter(t => t.side === 1)"
                                                    :key="item.team.id">
                                                    <div class="list-group-item team-card" :data-team="item.team.id">
                                                        <strong x-text="item.team.player1.name"></strong>
                                                        <span class="text-muted"> & </span>
                                                        <strong x-text="item.team.player2.name"></strong>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- SIDE 2 -->
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small mb-1">Side 2</div>
                                            <div class="list-group team-drop" :data-match="match.match_id" data-side="2">
                                                <template x-for="item in match.teams.filter(t => t.side === 2)"
                                                    :key="item.team.id">
                                                    <div class="list-group-item team-card" :data-team="item.team.id">
                                                        <strong x-text="item.team.player1.name"></strong>
                                                        <span class="text-muted"> & </span>
                                                        <strong x-text="item.team.player2.name"></strong>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
    <script>
        function matchmaking(initialMatches) {
            return {
                matches: initialMatches,

                init() {
                    this.$nextTick(() => {
                        document.querySelectorAll('.team-drop').forEach(el => {
                            new Sortable(el, {
                                group: 'teams',
                                animation: 150,
                                onAdd: (evt) => {
                                    const teamId = evt.item.dataset.team;
                                    // const matchId = evt.to.dataset.match;
                                    const fromMatch = evt.from.dataset.match;
                                    const toMatch = evt.to.dataset.match;
                                    const side = evt.to.dataset.side;

                                    if (fromMatch !== toMatch) {
                                        this.swapCrossMatch(teamId, fromMatch, toMatch, side);
                                        return;
                                    }
                                    this.updateTeam(teamId, toMatch, side);
                                }
                            });
                        });
                    });
                },

                updateTeam(teamId, matchId, side) {
                    fetch('/matchmaking/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({
                            team_id: teamId,
                            match_id: matchId,
                            side: side
                        })
                    });
                },
                swapCrossMatch(teamId, fromMatch, toMatch, side) {
                    fetch('/matchmaking/swap-cross', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({
                            team_id: teamId,
                            from_match: fromMatch,
                            to_match: toMatch,
                            side: side
                        })
                    });
                }

            }
        }
    </script>
@endpush
