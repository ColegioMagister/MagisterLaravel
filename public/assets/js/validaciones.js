

export function valTeacher(email, callback){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/check-teacher',
        method: 'POST',
        data:{
            email:email,
            _token:token
        },
        success: function(response){
            callback(response.valueEmail);
        }
    });
}

export function valUser(username, callback){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/check-user',
        method: 'POST',
        data:{
            username:username,
            _token:token
        },
        success: function(response){
            callback(response.valueUser);
        }
    });
}