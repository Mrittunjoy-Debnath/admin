@extends('layout.app')

@section('content')

<div id="mainDivCourse" class="d-none container">
    <div class="row">
    <div class="col-md-12 p-5">
        <button id="addNewCourseBtnId" class="my-3 btn btn-sm btn-danger">Add New</button>
    <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>

          <th class="th-sm">Name</th>
          <th class="th-sm">Fee</th>
          <th class="th-sm">Class</th>
          <th class="th-sm">Enroll</th>
          <th class="th-sm">Edit</th>
          <th class="th-sm">Delete</th>
        </tr>
      </thead>
      <tbody id="course_table">



      </tbody>
    </table>

    </div>
    </div>
    </div>

    <div id="loaderDivCourse" class="container">
        <div class="row">
        <div class="col-md-12 text-center p-5">
            <img class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">

        </div>
        </div>
        </div>

        <div id="WrongDivCourse" class="container d-none">
            <div class="row">
            <div class="col-md-12 text-center p-5">
                <h1>Something went wrong !</h1>


            </div>
        </div>
        </div>

        <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-body p-3 text-center">
      <h5 class="mt-4">Do You Want To Delete?</h5>
      <h5 id="CourseDeleteId" class="mt-4 d-none"> </h5>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
      <button  id="CourseDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
        <h5 id="courseEditId" class="mt-4 d-none"> </h5>


       <div id="courseEditForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>

       <img id="courseEditLoader" class="loading-icon m-5" src="{{ asset('images/loader.svg') }}">
       <h4 id="courseEditWrong" class="d-none">Something went wrong !</h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@endsection


@section('script')
    <script type="text/javascript">
        getCoursesData();

        function getCoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');
                $('#courseDataTable').DataTable().destroy();
                $('#course_table').empty();


                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + " </td>" +
                        "<td>" + jsonData[i].course_totalenroll + " </td>" +


                        "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></td>" +
                        "<td><a class='courseDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"

                    ).appendTo('#course_table');
                });

                $('.courseDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                })


                $('.courseEditBtn').click(function() {
                    var id = $(this).data('id');
                    courseUpdateDetails(id);

                    $('#courseEditId').html(id);

                    $('#updateCourseModal').modal('show');
                })

                $('#courseDataTable').DataTable({ "order": false });
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDivCourse').addClass('d-none');
                $('#WrongDivCourse').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#loaderDivCourse').addClass('d-none');
            $('#WrongDivCourse').removeClass('d-none');
        });
}
$('#addNewCourseBtnId').click(function() {


    $('#addCourseModal').modal('show');
});

$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();
    CoursesAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);
})

function CoursesAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course name is empty');
    } else if (CourseDes.length == 0) {
        toastr.error('Course description is empty');
    } else if (CourseFee.length == 0) {
        toastr.error('CourseFee is empty');
    } else if (CourseEnroll.length == 0) {
        toastr.error('CourseEnroll is empty');
    } else if (CourseClass.length == 0) {
        toastr.error('Course Class is empty');
    } else if (CourseLink.length == 0) {
        toastr.error('CourseLink is empty');
    } else if (CourseImg.length == 0) {
        toastr.error('Course Img is empty');
    } else {

        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

        axios.post('/CoursesAdd', {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,
            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Add Success');
                        getCoursesData();

                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Courses Add failed');
                        getServicesData();
                    }
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something went wrong');
                }
            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something went wrong');
            });
    }

}

//course delete confirm
$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);
})

//course delete
function CourseDelete(deleteID) {
    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/CoursesDelete', { id: deleteID })
        .then(function(response) {
            $('#CourseDeleteConfirmBtn').html("Yes");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Success');
                    getCoursesData();

                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Something went wrong');
                    getCoursesData();
                }
            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Something went wrong');
            }

        })
        .catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Delete failed');
        });
}


//course update

function courseUpdateDetails(detailsID) {
    axios.post('/CoursesDetails', { id: detailsID })
        .then(function(response) {
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');
                var jsonData = response.data;

                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);

            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }
        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
        });
}

$('#CourseUpdateConfirmBtn').click(function() {

    var courseID = $('#courseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDes = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();

    CourseUpdate(courseID, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg);
})


function CourseUpdate(courseID, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg) {
    if (courseName.length == 0) {
        toastr.error('course name is empty');
    } else if (courseDes.length == 0) {
        toastr.error('course description is empty');
    } else if (courseFee.length == 0) {
        toastr.error('Service image is empty');
    } else if (courseEnroll.length == 0) {
        toastr.error('courseEnroll is empty');
    } else if (courseClass.length == 0) {
        toastr.error('courseClass is empty');
    } else if (courseLink.length == 0) {
        toastr.error('courseLink is empty');
    } else if (courseImg.length == 0) {
        toastr.error('courseImg is empty');
    } else {

        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

        axios.post('/CoursesUpdate', {
                id: courseID,
                course_name: courseName,
                course_des: courseDes,
                course_fee: courseFee,
                course_totalenroll: courseEnroll,
                course_totalclass: courseClass,
                course_link: courseLink,
                course_img: courseImg,
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save");
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Success');
                        getCoursesData();

                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update failed');
                        getCoursesData();
                    }
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something went wrong');
                }
            })
            .catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something went wrong');
            });
    }

}

    </script>
@endsection
