<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$staff->name()}}</title>

    <style>
        .page-break {
            page-break-after: always;
        }

        .logo {
            display: block;
            text-align: center;
        }

        .logo img {
            position: absolute;
            top: 5%;
            left: 50%;
            transform: translate(-50%, -5%);
            max-width: 150px;
            max-height: 150px;
        }

        .field-label {
            display: inline-block;
            width: 200px;
            text-align: right;
        }

        .field-value {
            display: inline-block;
            width: auto;
            text-align: right;
            padding-left: 50px;

        }
    </style>

</head>
<body>

<main>
    @php
        $logo = Organization::get('logo');
    @endphp
        <!-- Front page -->
    <div class="row">
        <div class="col-md-12">

            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset("storage/{$logo}") }}" class="img-fluid"/>
            </div>

            <!-- Front page text -->
            <div class="text-center" style="margin-top: 300px">
                <h2>Staff Record</h2>
                <h3>For</h3>
                <h2>{{$staff->fullname()}}</h2>
                <h4 class="text-muted">{{$staff->employment->getPosition()}}</h4>
            </div>

            <!-- Front page date -->
            <div class="text-center" style="margin-top: 300px">
                <h5>{{now()->format('d-M-Y')}}</h5>
            </div>
        </div>
    </div>
    <!-- End Front page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">A. Personal Information</h4>
            <p class="mb-3">
                <span class="text-bold field-label"> Staff Number : </span>
                <span class="text-bold field-value">{{$staff->employee_number}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> National ID : </span>
                <span class="text-bold field-value">{{$staff->national_id}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Title : </span>
                <span class="text-bold field-value">{{$staff->title}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Firstname : </span>
                <span class="text-bold field-value">{{$staff->firstname}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Lastname : </span>
                <span class="text-bold field-value">{{$staff->lastname}}</span>
            </p>
            @isset($staff->middlename)
                <p class="mb-3">
                    <span class="text-bold field-label"> Middlename : </span>
                    <span class="text-bold field-value">{{$staff->middlename}}</span>
                </p>
            @endif
            <p class="mb-3">
                <span class="text-bold field-label">Gender : </span>
                <span class="text-bold field-value">{{$staff->gender}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label">Marital Status : </span>
                <span class="text-bold field-value">{{$staff->marital_status}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label">Date of Birth : </span>
                <span class="text-bold field-value">{{$staff->dateOfBirth()}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Home Village : </span>
                <span class="text-bold field-value">{{ $staff->home_village }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Home T/A : </span>
                <span class="text-bold field-value">{{ $staff->home_authority }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Home District : </span>
                <span class="text-bold field-value">{{ $staff->home_district }}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label">Home Country : </span>
                <span class="text-bold field-value">{{ $staff->home_country }}</span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">B. Contact Information</h4>
            <p class="mb-3">
                <span class="text-bold field-label">Contact Address : </span>
                <span class="text-bold field-value">{{$staff->contact_address}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Official Email : </span>
                <span class="text-bold field-value">{{$staff->official_email}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Personal Email : </span>
                <span class="text-bold field-value">{{$staff->personal_email}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Mobile Contact : </span>
                <span class="text-bold field-value">{{$staff->mobile_contact}}</span>
            </p>

            @isset($staff->home_contact)
                <p class="mb-3">
                    <span class="text-bold field-label">Home Contact : </span>
                    <span class="text-bold field-value">{{$staff->home_contact}}</span>
                </p>
            @endisset

        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">C. Employment Information</h4>

            <p class="mb-3">
                <span class="text-bold field-label">Position : </span>
                <span class="text-bold field-value">{{$staff->employment->getPosition() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Tenure : </span>
                <span class="text-bold field-value">{{$staff->employment->getJobType() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Category : </span>
                <span class="text-bold field-value">{{$staff->employment->getJobCategory() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Ranking : </span>
                <span class="text-bold field-value">{{$staff->employment->getJobRank() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label"> Grade Scale : </span>
                <span class="text-bold field-value">{{$staff->employment->getGradeScale() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label"> Department : </span>
                <span class="text-bold field-value">{{$staff->employment->getDepartment() }}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Section/Unit : </span>
                <span class="text-bold field-value">{{$staff->employment->getSection() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label"> Branch/Campus : </span>
                <span class="text-bold field-value">{{$staff->employment->getCampus() }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Appointment Date : </span>
                <span class="text-bold field-value">{{$staff->employment->startDate()}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label">Period Of Service : </span>
                <span class="text-bold field-value">{{$staff->employment->elapsedPeriod()}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Job Status : </span>
                <span class="text-bold field-value">{{ $staff->employment->getJobStatus() }}</span>
            </p>
        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">D. Spouse Information</h4>

            <p class="mb-3">
                <span class="text-bold field-label"> Title : </span>
                <span class="text-bold field-value">{{$staff->spouse->title}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Firstname : </span>
                <span class="text-bold field-value">{{$staff->spouse->firstname}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Lastname : </span>
                <span class="text-bold field-value">{{$staff->spouse->lastname}}</span>
            </p>
            @isset($staff->spouse->middlename)
                <p class="mb-3">
                    <span class="text-bold field-label"> Middlename : </span>
                    <span class="text-bold field-value">{{$staff->spouse->middlename}}</span>
                </p>
            @endisset
            <p class="mb-3">
                <span class="text-bold field-label">Gender : </span>
                <span class="text-bold field-value">{{$staff->spouse->gender}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Date of Birth : </span>
                <span class="text-bold field-value">{{$staff->spouse->dateOfBirth()}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Email : </span>
                <span class="text-bold field-value">{{$staff->spouse->contact_email}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Number : </span>
                <span class="text-bold field-value">{{$staff->spouse->contact_number}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Address: </span>
                <span class="text-bold field-value">{{$staff->spouse->contact_address}}</span>
            </p>


            <p class="mb-3">
                <span class="text-bold field-label">Home Village : </span>
                <span class="text-bold field-value">{{ $staff->spouse->home_village }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Home T/A : </span>
                <span class="text-bold field-value">{{ $staff->spouse->home_authority }}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Home District : </span>
                <span class="text-bold field-value">{{ $staff->spouse->home_district }}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label">Residence Country : </span>
                <span class="text-bold field-value">{{ $staff->spouse->residence_country }}</span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">E. Next of Kin</h4>

            <p class="mb-3">
                <span class="text-bold field-label"> Name : </span>
                <span class="text-bold field-value">{{$staff->kinsman->name()}}</span>
            </p>
            <p class="mb-3">
                <span class="text-bold field-label"> Relation : </span>
                <span class="text-bold field-value">{{$staff->kinsman->relation}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Occupation : </span>
                <span class="text-bold field-value">{{$staff->kinsman->occupation}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Organization : </span>
                <span class="text-bold field-value">{{$staff->kinsman->organization}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Email : </span>
                <span class="text-bold field-value">{{$staff->kinsman->contact_email}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Number : </span>
                <span class="text-bold field-value">{{$staff->kinsman->contact_number}}</span>
            </p>

            <p class="mb-3">
                <span class="text-bold field-label">Contact Address : </span>
                <span class="text-bold field-value">{{$staff->kinsman->contact_address}}</span>
            </p>


        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">F. Dependants</h4>

            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Relation</th>
                </tr>
                </thead>

                <tbody>
                @foreach($staff->dependants as $key=> $dependant )
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$dependant->fullname()}}</td>
                        <td>{{$dependant->gender}}</td>
                        <td>{{$dependant->dateOfBirth()}}</td>
                        <td>{{$dependant->relation}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">G. Academic/Professional Qualifications</h4>

            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Specialty</th>
                    <th>Institution</th>
                    <th>Country</th>
                    <th>Year</th>
                </tr>
                </thead>

                <tbody>
                @foreach($staff->qualifications as $key=> $qualification )
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$qualification->name}}</td>
                        <td>{{$qualification->getLevel()}}</td>
                        <td>{{$qualification->specialization}}</td>
                        <td>{{$qualification->institution}}</td>
                        <td>{{$qualification->country}}</td>
                        <td>{{$qualification->year}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">H. References</h4>

            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Relation</th>
                    <th>Organization</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
                    <th>Contact Address</th>
                </tr>
                </thead>

                <tbody>
                @foreach($staff->referees as $key=> $referee )
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$referee->fullname()}}</td>
                        <td>{{$referee->relation}}</td>
                        <td>{{$referee->organization}}</td>
                        <td>{{$referee->contact_number}}</td>
                        <td>{{$referee->contact_email}}</td>
                        <td>{{$referee->contact_address}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <!-- End page -->

    <!-- page break -->
    <div class="page-break"></div>

    <!-- Start page-->
    <div class="row">
        <div class="col-md-12">
            <h4 class="py-4 mb-3">I. Career Progress</h4>

            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Position</th>
                    <th>Job Type</th>
                    <th>Job Status</th>
                    <th>Progress</th>
                    <th>Grade</th>
                    <th>Notch</th>
                    <th>Date</th>
                    >
                </tr>
                </thead>

                <tbody>
                @foreach($staff->orderedProgress() as $key => $progress )
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$progress->getPosition()}}</td>
                        <td>{{$progress->getJobType()}}</td>
                        <td>{{$progress->getJobStatus()}}</td>
                        <td>{{$progress->getProgressType()}}</td>
                        <td>{{$progress->grade}}</td>
                        <td>{{$progress->notch}}</td>
                        <td>{{$progress->startDate()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End page -->

</main>

<!-- Script for adding Page Number -->
<script type="text/php">
            if (isset($pdf)) {
                $text = "page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width) / 2;
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }

</script>
<!-- End script -->

</body>
</html>
