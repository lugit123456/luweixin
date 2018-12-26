var Login = function (){

    return {
        
        //Masking
        initLogin: function () {
	        // Validation for login form
	        $("#sky-form1").validate({
	            // Rules for form validation
	            rules:
	            {
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                password:
	                {
	                    required: true,
	                    minlength: 3,
	                    maxlength: 20
	                }
	            },

	            // Messages for form validation
	            messages:
	            {
	                email:
	                {
	                    required: '请输入有效账号 ',
	                    email: '请重新输入您的账号 '
	                },
	                password:
	                {
	                    required: '请输入密码'
	                }
	            },

	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }
	        });
        }

    };

}();

