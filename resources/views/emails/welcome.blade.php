Hello new user {{$user->name}},

Thank you for creating account . To verify your email please click on the link below: 

{{route('verify', $user->verification_token)}}