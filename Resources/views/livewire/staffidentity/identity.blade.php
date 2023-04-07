<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h6>Passport Photo</h6>

                        @if(!is_null($staff->avatar))
                            <img src="{{ asset('storage/'.$staff->avatar) }}" class="img-fluid img-thumbnail"/>
                        @else
                            <img src="{{ asset('img/default.png') }}" class="img-fluid img-thumbnail"/>
                        @endif

                    </div>

                    <div class="col-lg-6">
                        <h6>Signature (350px by 230px)</h6>
                        @if(!is_null($staff->signature))
                            <img src="{{ asset("storage/".$staff->signature) }}" class="img-fluid img-circle"/>
                        @endif

                    </div>
                </div>

            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-title">Update Identity</div>

            </div>
            <div class="card-body">
                <x-adminlte-validation/>

                <form wire:submit.prevent="saveAvatar">

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="control-label">Profile Picture *</label>
                            <div class="input-group">
                                <input type="file" wire:model="avatar" class="form-control">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-check-circle"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

                <form wire:submit.prevent="saveSignature">

                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="control-label">Signature *</label>
                            <div class="input-group">
                                <input type="file" wire:model="signature" class="form-control">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-check-circle"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills nav-sidebar flex-column">

                    <li class="nav-item">
                        <a href="{{route('identity.index')}}" class="nav-link">
                            <p>New ID Card</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('identity.card', $staff->id)}}" class="nav-link" target="_blank">
                            <p>Print ID Card</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('staff.show', $staff->id)}}" class="nav-link">
                            <p>View Staff Profile</p>
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</div>
