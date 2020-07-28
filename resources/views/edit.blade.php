 <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

 <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
<style type="text/css">
    
input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
<!-- @section('content') -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Users</h2>
        </div>
        <div class="pull-right">
           <a class="btn btn-success" href="{{ url()->previous() }}"> Back </a> 
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<body>
<form action="{{('update')}}" method="Post"  id="myform" enctype="multipart/form-data">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
  
    <input type="hidden" name="id" value="{{$data->id}}">
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" id="name" value="{{$data->name}}" placeholder="Name">
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group divimg">
                <strong>Profile Picture:</strong>
             
              <input type="file" id="file" name="profile_picture" class="form-control" value='{{URL::asset("uploads/$data->profile_picture")}}' accept="image/png,image/jpg,image/jpeg">
              <div id="preview">
                <img src='{{URL::asset("uploads/$data->profile_picture")}}'  width="200px" height="200px">
               </div>
             <!--  <a href="javascript:changeProfile()">Change</a> |
              <a style="color: red" href="javascript:removeImage()">Remove</a> -->
                
            </div>
        </div>

       
        <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" id="phone"   value="{{$data->phone}}" class="form-control required" placeholder="Phone">
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" id="email"  value="{{$data->email}}" class="form-control" placeholder="Email">
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-5">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm_password" id="confirm_password"  class="form-control" placeholder="Confirm password">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
</body>

<script type="text/javascript">
    
/*function delete(no) {  
            document.getElementById("uploadImage"+no).value = "";  
}

function PreviewImage(no) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
    }*/

     $.validator.addMethod('customphone', function (value, element) {
        return this.optional(element) || /^(\+91-|\+91|0)?\d{10}$/.test(value);
    }, '<span style="color:red"> Please enter a valid phone number with country code</span>');
      $.validator.addMethod("passwordCheck",
        function(value, element, param) {
            if (this.optional(element)) {
                return true;
            } else if (!/[A-Z]/.test(value)) {
                return false;
            } else if (!/[a-z]/.test(value)) {
                return false;
            } else if (!/[0-9]/.test(value)) {
                return false;
            }

            return true;
        },
        '<span style="color:red"> must be one Alphabet and one Small character and one number</span>');

    $(document).ready(function () {
        $("#myform").validate({
            rules: {
                name: 'required',
                //profile_picture: 'required',
                email: 'required',
                phone: 'customphone',

                password: {
                    required: true,
                    minlength: 5,
                    passwordCheck:true
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
                
        
                // username: {
                //     required: true,
                //     minlength: 2,
                //     remote: "users.php"
                // }
            },
              messages: {
                'name': {
                  required: '<span style="color:red">Please enter the name</span>',
                },
                'profile_picture': {
                  required: '<span style="color:red">Please select the Profile picture</span>',
                },
                'email': {
                  required: '<span style="color:red">Please enter the email</span>',
                   email: '<span style="color:red">Please enter the valid emails</span>'
                },
                'phone': {
                  required: '<span style="color:red">Please enter the phone number</span>',
                },
                'password': {
                  required: '<span style="color:red">Please enter the password</span>',
                  minlength:'<span style="color:red">Please enter min 5 character</span>'
                },
                'confirm_password': {
                  required: '<span style="color:red">Please enter the password</span>',
                  minlength:'<span style="color:red">Please enter min 5 character</span>',
                  equalTo:'<span style="color:red">Must be same password</span>',

                }
              }

        });
    });


   /* function changeProfile() {
        $('#image').click();
    }
    $('#image').change(function () {
        var imgPath = this.value;
        var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
            readURL(this);
        else
            alert("Please select image file (jpg, jpeg, png).")
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
//              $("#remove").val(0);
            };
        }
    }
    function removeImage() {
        $('#preview').attr('src', 'noimage.jpg');
//      $("#remove").val(1);
    }
*/

function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#preview + img').remove();
            $('#preview').html('');
            $('#preview').after('<img src="'+e.target.result+'" width="200" height="200"/>');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#file").change(function () {
    filePreview(this);
});

// var abc = 0;
// $('body').on('change', '#file', function ()
//             {
//                 if (this.files && this.files[0])
//                 {
//                     abc += 1; //increementing global variable by 1
//                     var z = abc - 1;
//                     var x = $(this)
//                         .parent()
//                         .find('#previewimg' + z).remove();
//                     $(this).append("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
//                     var reader = new FileReader();
//                     reader.onload = imageIsLoaded;
//                     reader.readAsDataURL(this.files[0]);
//                     $(this)
//                         .hide();
//                     $("#abcd" + abc).append($("<img/>",{
//                                 id: 'img',
//                                 src: 'x.png', //the remove icon
//                                 alt: 'delete'
//                             }) .click(function ()
//                             {
//                                 $(this)
//                                     .parent()
//                                     .parent()
//                                     .remove();
//                             }));
//                 }
//             });





//  function imageIsLoaded(e)
//         {
//             $('#previewimg' + abc)
//                 .attr('src', e.target.result);
//         };

// $("#abcd1#img").click(function () {
//     alert('iohiuhk');
//     //var template = $('#appendTemplate").html();
//   //  $(".divimg").append('<div id="filediv">  <input type="file" name="profile_picture" id="file" class="form-control fileUpload"></div>')
// });

  /* function readURL() {
        var $input = $(this);
        var $newinput =  $(this).parent().parent().parent().find('.portimg ');
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                reset($newinput.next('.delbtn'), true);
                $newinput.attr('src', e.target.result).show();
                $newinput.after('<input type="button" class="delbtn removebtn" value="remove">');
            }
            reader.readAsDataURL(this.files[0]);
        }
    }
    $(".fileUpload").change(readURL);
    $("form").on('click', '.delbtn', function (e) {
        reset($(this));
    });

    function reset(elm, prserveFileName) {
        if (elm && elm.length > 0) {
            var $input = elm;
            $input.prev('.portimg').attr('src', '').hide();
            if (!prserveFileName) {
                $($input).parent().parent().parent().find('input.fileUpload ').val("");
                //input.fileUpload and input#uploadre both need to empty values for particular div
            }
            elm.remove();
        }
    }
*/
</script>
