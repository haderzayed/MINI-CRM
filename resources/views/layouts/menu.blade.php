<!-- need to remove -->
<li class="nav-item">
    <a href="{{route('companies.index')}}" class="nav-link {{ (request()->is(app()->getLocale().'/companies*')) ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>{{trans('Companies.Companies')}}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('ContactPeople.index')}}" class="nav-link {{ (request()->is(app()->getLocale().'/ContactPeople*')) ? 'active' : '' }}">
        <i class="nav-icon far fa-image"></i>
        <p>{{trans('Contacts.contacts')}}</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('admins.index')}}" class="nav-link {{ (request()->is(app()->getLocale().'/admins*')) ? 'active' : '' }}">
        <i class="nav-icon far fa-image"></i>
        <p>{{trans('Admins.admins')}}</p>
    </a>
</li>
