<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Career Progress</h3>
    </div>
    <div class="card-body">
        @foreach ($staff->orderedProgress() as $progress)
            <div class="timeline">

                <div class="time-label">
                <span class="bold">
                    {{$progress->getDescription() }}
                </span>

                    @if( $progress->isActive()  && !$progress->isPermanent() )
                        <button wire:click="delete({{$progress->id}})"
                                class=" float-right btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    @endif

                </div>

                <div>
                    <i class="fas fa-user bg-blue"></i>
                    <div class="timeline-item">
                        <div class="timeline-header">
                            <p>
                                <a href="#" class="text-bold">{{$progress->getPosition()}}</a>

                                <span class="float-right">
                                {!! $progress->statusBadge() !!}
                            </span>

                            </p>

                        </div>
                        <div class="timeline-body">
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <strong>Job Type: </strong><span>{{$progress->getJobType()}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Job Grade: </strong><span>{{$progress->getGradeScale()}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Job Status: </strong><span>{{$progress->getJobStatus()}}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong>Started On: </strong><span>{{$progress->startDate()}}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
