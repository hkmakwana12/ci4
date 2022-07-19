<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link <?= ($menu2 == 'hpi') ? 'active' : '' ?>" href="?menu1=emr&menu2=hpi">History of Present Illness</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($menu2 == 'history') ? 'active' : '' ?>" href="?menu1=emr&menu2=history">History</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($menu2 == 'ce') ? 'active' : '' ?>" href="?menu1=emr&menu2=ce">Clinical Examination</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($menu2 == 'diagnosis') ? 'active' : '' ?>" href="?menu1=emr&menu2=diagnosis">Diagnosis</a>
    </li>
</ul>