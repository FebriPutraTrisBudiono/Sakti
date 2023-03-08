@if ($listpermohonan_id->slug == 'sertifikasi_awal')
    <ul class="nav nav-tabs mb-4">
        @if (in_array('F-CER-01 - Daftar Isian Permohon.view', $roles))
            <?php $data = $client->permohonansertifikasi_data($listpermohonan_id->id)->first(); ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/permohonansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Permohonan Sertifikasi</a>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/permohonansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            aria-current="page"
                            href="/dashboard/permohonansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-1
                            Permohoan
                            Sertifikasi
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (in_array('F-CER-02 - Kajian Permohon.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->kajianclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian
                        Permohonan</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/kajianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($datastatus ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-02
                                Kajian Permohonan
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->permohonansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                    $client->permohonansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->kajianclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian
                            Permohonan</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/kajianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($datastatus ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-02
                                    Kajian Permohonan
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->perjanjianclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Perjanjian
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/perjanjianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>DOC-CER-01
                                Kontrak Sertifikasi
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->kajianclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->kajianclient_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->perjanjianclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Perjanjian
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/perjanjianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>DOC-CER-01
                                    Kontrak Sertifikasi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->rencanaclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Rencana 1
                        Siklus</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/rencanaclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-03
                                Rencana Siklus Sertifikasi
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->perjanjianclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->perjanjianclient_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->rencanaclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Rencana 1
                            Siklus</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/rencanaclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-03
                                    Rencana Siklus Sertifikasi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles) ||
            in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles) ||
            in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage I</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                    Penunjukan Tim
                                    Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
                            <?php $data = $client->stage1checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06
                                    Check List Audit Stage I
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->rencanaclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->rencanaclient_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage
                            I</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                                @if ($client->rencanaclient_data($listpermohonan_id->id)->first() != '' &&
                                    $client->rencanaclient_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                            Kajian Tim Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                                @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                            Penunjukan Tim
                                            Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
                                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06
                                            Check List Audit Stage I
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-05 - Rencana Audit.view', $roles) ||
            in_array('F-CER-06B - Checklist Audit Stage II.view', $roles) ||
            in_array('F-CER-07 - Daftar Hadir Audit.view', $roles) ||
            in_array('F-CER-08 - Laporan Audit.view', $roles) ||
            in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles) ||
            in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles) ||
            in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*')? 'active': '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage II</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                    Penunjukan Tim
                                    Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                            <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                    Rencana Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                            <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                    Check List Audit Stage
                                    II
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                            <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                    Daftar Hadir Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                            <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                    Laporan Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                            <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Lembar
                                    Ketidaksesuaian
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                            <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                    Survei Kepuasan
                                    Pelanggan
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                            <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Verifikasi Temuan
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->stage1checkaudit_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage1checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*')? 'active': '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage
                            II</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                                @if ($client->stage1checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                            Kajian Tim Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                                @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                            Penunjukan Tim
                                            Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                                @if ($client->stage1checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                            Rencana Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                                @if ($client->stage2rencanaaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2rencanaaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                            Check List Audit Stage
                                            II
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                                @if ($client->stage2checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                            Daftar Hadir Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                                @if ($client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                            Laporan Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                                @if ($client->stage2laporanaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2laporanaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Lembar
                                            Ketidaksesuaian
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                                @if ($client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                            Survei Kepuasan
                                            Pelanggan
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Verifikasi Temuan
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles) ||
            in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles))
                            <?php $data = $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/reviewkeputusansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-11
                                    Review Keputusan
                                    Sertifikasi
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
                            <?php $data = $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/memopenerbitansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-12
                                    Memo Penerbitan
                                    Sertifikasi
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles))
                                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/reviewkeputusansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-11
                                            Review Keputusan
                                            Sertifikasi
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
                                @if ($client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                                    $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/memopenerbitansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-12
                                            Memo Penerbitan
                                            Sertifikasi
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('Penerbitan Sertifikasi.view', $roles))
            @if ($client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penerbitan
                        Sertifikat</a>
                    <ul class="dropdown-menu">
                        <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Penerbitan
                                Sertifikat
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endif
    </ul>
@elseif ($listpermohonan_id->slug == 'surveilance1')
    <ul class="nav nav-tabs mb-4">
        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles) ||
            in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penugasan</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '')
                                <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                        href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                        Penunjukan Tim
                                        Audit
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penugasan</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                        href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                        Penunjukan Tim
                                        Audit
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </li>
            @endif
        @endif
        @if (in_array('F-CER-05 - Rencana Audit.view', $roles) ||
            in_array('F-CER-06B - Checklist Audit Stage II.view', $roles) ||
            in_array('F-CER-07 - Daftar Hadir Audit.view', $roles) ||
            in_array('F-CER-08 - Laporan Audit.view', $roles) ||
            in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles) ||
            in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Audit</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                            <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                    Rencana Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                            <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                    Check List Audit Stage II
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                            <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                    Daftar Hadir Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                            <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                    Laporan Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                            <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Lembar
                                    Ketidaksesuaian
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                            <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                    Survei Kepuasan
                                    Pelanggan
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Audit</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                            Rencana Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                                @if ($client->stage2rencanaaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2rencanaaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                            Check List Audit Stage II
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                                @if ($client->stage2checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                            Daftar Hadir Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                                @if ($client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                            Laporan Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                                @if ($client->stage2laporanaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2laporanaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Lembar
                                            Ketidaksesuaian
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                                @if ($client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                            Survei Kepuasan
                                            Pelanggan
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles) || in_array('Penerbitan Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                            <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Verifikasi Temuan
                                </a>
                            </li>
                        @endif
                        @if (in_array('Penerbitan Sertifikasi.view', $roles))
                            <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Surat
                                    Keputusan Surveilance
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif(auth()->user()->level_id == 2)
                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Verifikasi Temuan
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('Penerbitan Sertifikasi.view', $roles))
                                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Surat
                                            Keputusan Surveilance
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
    </ul>
@elseif ($listpermohonan_id->slug == 'surveilance2')
    <ul class="nav nav-tabs mb-4">
        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles) ||
            in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penugasan</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                    Penunjukan Tim
                                    Audit
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penugasan</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                        href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                        Penunjukan Tim
                                        Audit
                                    </a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </li>
            @endif
        @endif
        @if (in_array('F-CER-05 - Rencana Audit.view', $roles) ||
            in_array('F-CER-06B - Checklist Audit Stage II.view', $roles) ||
            in_array('F-CER-07 - Daftar Hadir Audit.view', $roles) ||
            in_array('F-CER-08 - Laporan Audit.view', $roles) ||
            in_array('F-CER-09 - Verifikasi Temuan.view', $roles) ||
            in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Audit</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                            <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                    Rencana Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                            <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                    Check List Audit Stage II
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                            <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                    Daftar Hadir Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                            <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                    Laporan Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                            <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Lembar
                                    Ketidaksesuaian
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                            <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                    Survei Kepuasan
                                    Pelanggan
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Audit</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                            Rencana Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                                @if ($client->stage2rencanaaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2rencanaaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                            Check List Audit Stage II
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                                @if ($client->stage2checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                            Daftar Hadir Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                                @if ($client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                            Laporan Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                                @if ($client->stage2laporanaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2laporanaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Lembar
                                            Ketidaksesuaian
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                                @if ($client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                            Survei Kepuasan
                                            Pelanggan
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles) || in_array('Penerbitan Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                            <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Verifikasi Temuan
                                </a>
                            </li>
                        @endif
                        @if (in_array('Penerbitan Sertifikasi.view', $roles))
                            <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Surat
                                    Keputusan Surveilance
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Verifikasi Temuan
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('Penerbitan Sertifikasi.view', $roles))
                                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Surat
                                            Keputusan Surveilance
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
    </ul>
@elseif ($listpermohonan_id->slug == 'resertifikasi')
    <ul class="nav nav-tabs mb-4">
        @if (in_array('F-CER-01 - Daftar Isian Permohon.view', $roles))
            <?php $data = $client->permohonansertifikasi_data($listpermohonan_id->id)->first(); ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Request::is('dashboard/permohonansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                    data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Permohonan
                    Sertifikasi</a>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard/permohonansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            aria-current="page"
                            href="/dashboard/permohonansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-1
                            Permohoan
                            Sertifikasi
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (in_array('F-CER-02 - Kajian Permohon.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->kajianclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian
                        Permohonan</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/kajianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($datastatus ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-02
                                Kajian Permohonan
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->permohonansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                    $client->permohonansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->kajianclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian
                            Permohonan</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/kajianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/kajianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($datastatus ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-02
                                    Kajian Permohonan
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->evaluasisatusiklussertifikasi_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/evaluasisatusiklussertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian Satu
                        Siklus
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/evaluasisatusiklussertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/evaluasisatusiklussertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-13
                                Evaluasi Satu Siklus Sertifikasi
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->kajianclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->kajianclient_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->evaluasisatusiklussertifikasi_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/evaluasisatusiklussertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Kajian
                            Satu
                            Siklus
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/evaluasisatusiklussertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/evaluasisatusiklussertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-13
                                    Evaluasi Satu Siklus Sertifikasi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('DOC-CER-01 - Kontrak Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->perjanjianclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Perjanjian
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/perjanjianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>DOC-CER-01
                                Kontrak Sertifikasi
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->evaluasisatusiklussertifikasi_data($listpermohonan_id->id)->first() != '' &&
                    $client->evaluasisatusiklussertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->perjanjianclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Perjanjian
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/perjanjianclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/perjanjianclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>DOC-CER-01
                                    Kontrak Sertifikasi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-03 - Rencana Siklus Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <?php $data = $client->rencanaclient_data($listpermohonan_id->id)->first(); ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Rencana 1
                        Siklus</a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/rencanaclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-03
                                Rencana Siklus Sertifikasi
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->perjanjianclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->perjanjianclient_data($listpermohonan_id->id)->first()->status == 2)
                    <?php $data = $client->rencanaclient_data($listpermohonan_id->id)->first(); ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Rencana 1
                            Siklus</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/rencanaclients/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/rencanaclients/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-03
                                    Rencana Siklus Sertifikasi
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles) ||
            in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles) ||
            in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage I</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                    Penunjukan Tim
                                    Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
                            <?php $data = $client->stage1checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06
                                    Check List Audit Stage I
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->rencanaclient_data($listpermohonan_id->id)->first() != '' &&
                    $client->rencanaclient_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage
                            I</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                                @if ($client->rencanaclient_data($listpermohonan_id->id)->first() != '' &&
                                    $client->rencanaclient_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                            Kajian Tim Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                                @if ($client->stage1kajiantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                            Penunjukan Tim
                                            Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06 - Check List Audit Stage I.view', $roles))
                                @if ($client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage1checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage1checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage1checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06
                                            Check List Audit Stage I
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles) ||
            in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles) ||
            in_array('F-CER-05 - Rencana Audit.view', $roles) ||
            in_array('F-CER-06B - Checklist Audit Stage II.view', $roles) ||
            in_array('F-CER-07 - Daftar Hadir Audit.view', $roles) ||
            in_array('F-CER-08 - Laporan Audit.view', $roles) ||
            in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles) ||
            in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles) ||
            in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*')? 'active': '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage II</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                            <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                    Kajian Tim Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                            <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                    Penunjukan Tim
                                    Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                            <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                    Rencana Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                            <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                    Check List Audit Stage
                                    II
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                            <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                    Daftar Hadir Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                            <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                    Laporan Audit
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                            <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Lembar
                                    Ketidaksesuaian
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                            <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                    Survei Kepuasan
                                    Pelanggan
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                            <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                    Verifikasi Temuan
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->stage1checkaudit_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage1checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*')? 'active': '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Stage
                            II</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-39 - Kajian Tim Audit.view', $roles))
                                <?php $data = $client->stage1kajiantimaudit_data($listpermohonan_id->id)->first(); ?>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('dashboard/stage2kajiantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                        href="/dashboard/stage2kajiantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-39
                                        Kajian Tim Audit
                                    </a>
                                </li>
                            @endif
                            @if (in_array('F-CER-04 - Penunjukan Tim Audit.view', $roles))
                                <?php $data = $client->stage1penunjukantimaudit_data($listpermohonan_id->id)->first(); ?>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('dashboard/stage2penunjukantimaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                        href="/dashboard/stage2penunjukantimaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-04
                                        Penunjukan Tim
                                        Audit
                                    </a>
                                </li>
                            @endif
                            @if (in_array('F-CER-05 - Rencana Audit.view', $roles))
                                @if ($client->stage1checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage1checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2rencanaaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2rencanaaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2rencanaaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-05
                                            Rencana Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-06B - Checklist Audit Stage II.view', $roles))
                                @if ($client->stage2rencanaaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2rencanaaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2checkaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2checkaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2checkaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-06B
                                            Check List Audit Stage
                                            II
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-07 - Daftar Hadir Audit.view', $roles))
                                @if ($client->stage2checkaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2checkaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2daftarhadiraudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2daftarhadiraudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-07
                                            Daftar Hadir Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-08 - Laporan Audit.view', $roles))
                                @if ($client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2daftarhadiraudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2laporanaudit_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2laporanaudits/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2laporanaudits/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i  class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "< class='fas fa-check-square me-1 text-success'></ i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-08
                                            Laporan Audit
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Lembar Ketidaksesuaian.view', $roles))
                                @if ($client->stage2laporanaudit_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2laporanaudit_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2ketidaksesuaianpages/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2ketidaksesuaianpages/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Lembar
                                            Ketidaksesuaian
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.view', $roles))
                                @if ($client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2ketidaksesuaianpage_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2surveikepuasancustomers/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2surveikepuasancustomers/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-10
                                            Survei Kepuasan
                                            Pelanggan
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-09 - Verifikasi Temuan.view', $roles))
                                @if ($client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2surveikepuasancustomer_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->stage2temuanverifcation_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/stage2temuanverifcations/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/stage2temuanverifcations/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-09
                                            Verifikasi Temuan
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles) ||
            in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                        Sertifikasi</a>
                    <ul class="dropdown-menu">
                        @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles))
                            <?php $data = $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/reviewkeputusansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-11
                                    Review Keputusan
                                    Sertifikasi
                                </a>
                            </li>
                        @endif
                        @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
                            <?php $data = $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/memopenerbitansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-12
                                    Memo Penerbitan
                                    Sertifikasi
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') || Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Keputusan
                            Sertifikasi</a>
                        <ul class="dropdown-menu">
                            @if (in_array('F-CER-11 - Review Keputusan Sertifikasi.view', $roles))
                                @if ($client->stage2temuanverifcation_data($listpermohonan_id->id)->first() != '' &&
                                    $client->stage2temuanverifcation_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/reviewkeputusansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/reviewkeputusansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-11
                                            Review Keputusan
                                            Sertifikasi
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (in_array('F-CER-12 - Memo Penerbitan Sertifikat.view', $roles))
                                @if ($client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                                    $client->reviewkeputusansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                                    <?php $data = $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('dashboard/memopenerbitansertifikasis/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                            href="/dashboard/memopenerbitansertifikasis/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>F-CER-12
                                            Memo Penerbitan
                                            Sertifikasi
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif
            @endif
        @endif
        @if (in_array('Penerbitan Sertifikasi.view', $roles))
            @if (auth()->user()->level_id != 2)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                        data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penerbitan
                        Sertifikat</a>
                    <ul class="dropdown-menu">
                        <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Penerbitan
                                Sertifikat
                            </a>
                        </li>
                    </ul>
                </li>
            @elseif (auth()->user()->level_id == 2)
                @if ($client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first() != '' &&
                    $client->memopenerbitansertifikasi_data($listpermohonan_id->id)->first()->status == 2)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                            data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Penerbitan
                            Sertifikat</a>
                        <ul class="dropdown-menu">
                            <?php $data = $client->penerbitansertifikat_data($listpermohonan_id->id)->first(); ?>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/penerbitansertifikats/' . $client->id . '/' . $listpermohonan_id->id . '/edit*') ? 'active' : '' }}"
                                    href="/dashboard/penerbitansertifikats/{{ $client->id }}/{{ $listpermohonan_id->id }}/edit"><?= ($data->status ?? '') == 1 ? "<i class='fas fa-minus-square me-1 text-warning'></i>" : (($data->status ?? '') == 2 ? "<i class='fas fa-check-square me-1 text-success'></i>" : (($data->status ?? '') == 3 ? "<i class='fas fa-minus-square me-1 text-danger'></i>" : '')) ?>Penerbitan
                                    Sertifikat
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        @endif
    </ul>
@endif
