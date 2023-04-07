<li class="nav-item">
    <a href="{{route('staffmanagement.module')}}" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>


@can('create-staff')
    <li class="nav-item">
        <a href="{{route('staff.create')}}" class="nav-link">
            <i class="nav-icon fas fa-plus-circle"></i>
            <p>Create Staff</p>
        </a>
    </li>
@endcan

@can('read-staff')
    <li class="nav-item">
        <a href="{{route('staff.index')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Staff Directory</p>
        </a>
    </li>
@endcan

@can('read-staff')
    <li class="nav-item">
        <a href="{{route('staff.search')}}" class="nav-link">
            <i class="nav-icon fas fa-search"></i>
            <p>Search Staff</p>
        </a>
    </li>
@endcan

@can('create-staff-card')
    <li class="nav-item">
        <a href="{{route('identity.index')}}" class="nav-link">
            <i class="nav-icon fas fa-id-card"></i>
            <p>Staff Identity</p>
        </a>
    </li>
@endcan

@can('update-employment')
    <li class="nav-item">
        <a href="{{route('confirmation.index')}}" class="nav-link">
            <i class="nav-icon fas fa-check-circle"></i>
            <p>Confirmation</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('reinstatement.index')}}" class="nav-link">
            <i class="nav-icon fas fa-redo"></i>
            <p>Reinstatement</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('contract.index')}}" class="nav-link">
            <i class="nav-icon fas fa-file-signature"></i>
            <p>Renew Contract</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('attrition.index')}}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Staff Attrition</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('appointment.index')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Appointments</p>
        </a>
    </li>

@endcan

@can('execute-staff-settings')

    <li class="nav-item">
        <a href="{{route('staffmanagement.settings.index')}}" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
        </a>
    </li>

@endcan




