<div class="col-md-2">
    <ul class="nav nav-pills flex-column bg-white rounded-sm shadow-sm">
        <li class="nav-item">
            <a class="nav-link <?= ($menu1 == 'profile') ? 'active' : '' ?>" href="?menu1=profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($menu1 == 'emr') ? 'active' : '' ?>" href="?menu1=emr" title="Electronic Medical Records">EMR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
    </ul>
</div>