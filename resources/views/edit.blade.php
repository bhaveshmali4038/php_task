<!DOCTYPE html>
<html>

<head>
    <title>Laravel Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- For Data-Feather Icon --}}
    <script src="https://kit.fontawesome.com/8efe6f18fe.js" crossorigin="anonymous"></script>
</head>

<body>
    @include('errors')
    <div class="container">
        <h1>User Details</h1>
        <form method="post" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}"
            enctype="multipart/form-data">
            @csrf                
            <div class="row">
                <div class="col-md-6 col-12">
                    <label class="form-label" for="full_name"><strong>Name</strong></label>
                    <input type="text" class="form-control" value="{{ isset($user) ? $user->name : '' }}"
                        name="name" placeholder="Enter Name" required>
                </div>
                <div class="col-md-6 col-12">
                    <label class="form-label" for="full_name"><strong>Email</strong></label><br>
                    <input type="email" name="email" class="form-control"
                        value="{{ isset($user) ? $user->email : '' }}" placeholder="Enter Email" required>
                </div>
            </div><br>

            <div class="row">
                <div class="col-md-6 col-12">
                    <label class="form-label" for="full_name"><strong>User Role</strong></label>
                    <select class="form-control" name="role" id="group_name" required>
                        <option value="" selected disabled>Select User Role</option>
                        <option value="1" {{ isset($user) && ($user->role == "1") ? 'selected':'' }}>Sales Executive</option>
                        <option value="2" {{ isset($user) && ($user->role == "2") ? 'selected':'' }}>CRM</option>
                        <option value="3" {{ isset($user) && ($user->role == "3") ? 'selected':'' }}>HR</option>
                        <option value="4" {{ isset($user) && ($user->role == "4") ? 'selected':'' }}>SEO</option>
                        <option value="5" {{ isset($user) && ($user->role == "5") ? 'selected':'' }}>BDE</option>
                    </select>
                </div>
                <div class="col-md-3 col-12">
                    <label class="form-label" for="full_name"><strong>Gender</strong></label><br>
                    <input type="radio" id="html" name="gender" value="Male" {{ isset($user) && ($user->gender == "Male") ? 'checked':'' }}>
                    <label for="html">Male</label><br>
                    <input type="radio" id="css" name="gender" value="Female" {{ isset($user) && ($user->gender == "Female") ? 'checked':'' }}>
                    <label for="css">Female</label><br>
                    <input type="radio" id="javascript" name="gender" value="Other" {{ isset($user) && ($user->gender == "Other") ? 'checked':'' }}>
                    <label for="javascript">Other</label>
                </div>
                <div class="col-md-3 col-12">
                    <label class="form-label" for="full_name"><strong>Hobbies</strong></label><br>
                    <input type="checkbox" id="h1" name="hobbies[]" value="Singing" {{isset($hobbies) && (in_array("Singing", $hobbies)) ? "checked" : ""}}>
                    <label for="h1">Singing</label>&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="h2" name="hobbies[]" value="Dancing" {{isset($hobbies) && (in_array("Dancing", $hobbies)) ? "checked" : ""}}>
                    <label for="h2"> Dancing</label>&nbsp;&nbsp;&nbsp;<br>
                    <input type="checkbox" id="h3" name="hobbies[]" value="Reading" {{isset($hobbies) && (in_array("Reading", $hobbies)) ? "checked" : ""}}>
                    <label for="h3"> Reading</label>&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="h4" name="hobbies[]" value="Traveling" {{isset($hobbies) && (in_array("Traveling", $hobbies)) ? "checked" : ""}}>
                    <label for="h4"> Traveling</label>&nbsp;&nbsp;&nbsp;<br>
                    <input type="checkbox" id="h5" name="hobbies[]" value="Swimming" {{isset($hobbies) && (in_array("Swimming", $hobbies)) ? "checked" : ""}}>
                    <label for="h5"> Swimming</label>&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" id="h6" name="hobbies[]" value="Playing" {{isset($hobbies) && (in_array("Playing", $hobbies)) ? "checked" : ""}}>
                    <label for="h6"> Playing</label>&nbsp;&nbsp;&nbsp;
                </div>
            </div><br>

            <div class="row">
                <div class="col-md-6 col-12">
                    <label class="form-label" for="full_name"><strong>Profile Image</strong></label>
                    @if (isset($user->profile_pic) && $user->profile_pic != '')
                        <input type="file" class="form-control" name="profile"><br>
                        <img src="{{ $user->profile_pic }}" style="width: 180px; border-radius: 10px;">
                    @else                    
                        <input type="file" class="form-control" name="profile" required><br>
                    @endif
                </div>  
                <div class="col-md-6 col-12">
                    <label class="form-label" for="full_name"><strong>Document</strong></label><br>
                    @if (isset($user->file) && $user->file != '')
                        <input type="file" class="form-control" name="document"><br><a href="{{$user->file}}" target="blank">
                        <i class="fa-solid fa-file fa-5x"></i></a>
                    @else
                        <input type="file" class="form-control" name="document" required><br>
                    @endif
                </div>
            </div><br>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">{{isset($user) ? "Edit User" : "Add User"}}</button>
                <a class="btn btn-secondary" href="{{ route('user.index') }}">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</body>
</html>
