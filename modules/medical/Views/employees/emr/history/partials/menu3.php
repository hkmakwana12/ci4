<ul class="nav nav-pills pt-3">
    <li class="nav-item">
        <a class="nav-link <?= ($menu3 == 'pmh') ? 'active' : '' ?>" href="?menu1=emr&menu2=history&menu3=pmh">Past Medical / Surgical History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($menu3 == 'personal') ? 'active' : '' ?>" href="?menu1=emr&menu2=history&menu3=personal">Personal History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($menu3 == 'family') ? 'active' : '' ?>" href="?menu1=emr&menu2=history&menu3=family">Family History</a>
    </li>
</ul>