@extends('dashbored.layoutdashbored')
@section('contentadmin')
<div class="row gy-4 mb-4">


    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card body -->
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between lh-1">
                    <div>
                        <span class="fs-6 text-uppercase fw-semibold ls-md">Gardener</span>
                    </div>
                    <div>
                        <span class="fe fe-users fs-3 text-primary"></span>
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <h2 class="fw-bold mb-0">1,22,456</h2>
                    <div class="d-flex flex-row gap-2">
                        <span class="text-success fw-semibold">
                            <i class="fe fe-trending-up me-1"></i>
                            +1200
                        </span>
                        <span class="fw-medium">Gardener</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-12 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card body -->
            <div class="card-body d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between lh-1">
                    <div>
                        <span class="fs-6 text-uppercase fw-semibold ls-md">Utilisateur Simple </span>
                    </div>
                    <div>
                        <span class="fe fe-user-check fs-3 text-primary"></span>
                    </div>
                </div>
                <div class="d-flex flex-column gap-1">
                    <h2 class="fw-bold mb-0">22,786</h2>
                    <div class="d-flex flex-row gap-1">
                        <span class="text-success fw-semibold">
                            <i class="fe fe-trending-up me-1"></i>
                            +200
                        </span>
                        <span class="ms-1 fw-medium">Utilisateur Simple</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row gy-4 mb-4">
    <div class="col-xl-8 col-lg-12 col-md-12 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Nomber of users</h4>
                </div>
                <div>
                    <div class="dropdown dropstart">
                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="courseDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="courseDropdown1">
                            <span class="dropdown-header">Settings</span>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-external-link dropdown-item-icon"></i>
                                Export
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-mail dropdown-item-icon"></i>
                                Email Report
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-download dropdown-item-icon"></i>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <!-- Earning chart -->
                <div id="earning" class="apex-charts"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header align-items-center card-header-height d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Users Types</h4>
                </div>
                <div>
                    <div class="dropdown dropstart">
                        <a class="btn-icon btn btn-ghost btn-sm rounded-circle" href="#" role="button" id="courseDropdown2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="courseDropdown2">
                            <span class="dropdown-header">Settings</span>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-external-link dropdown-item-icon"></i>
                                Export
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-mail dropdown-item-icon"></i>
                                Email Report
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fe fe-download dropdown-item-icon"></i>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div id="traffic" class="apex-charts d-flex justify-content-center"></div>
            </div>
        </div>
    </div>
</div>
@endsection
