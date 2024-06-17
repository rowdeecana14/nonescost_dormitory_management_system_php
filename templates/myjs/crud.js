var CRUD = {
    path: "",
    param: "",
    run: function() {
        return ajaxRun(this.path, this.param);
    }
}

function ajaxRun(path, param) {
    var response_data;
    $.ajax({
        async: false,
        url: path,
        //dataType: 'json',
        type: "POST",
        data: param,
        success: function(response) {   
          response_data = response;
        },
        error: function(){
          showError("error");
        }
    });

    return response_data;
}

function showError(message) {
	alert(message);
}