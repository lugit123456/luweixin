var Registration = function () {

    return {
        
        //Registration Form
        initRegistration: function () {
	        // Validation       
	        $("#sky-form4").validate({                   
	            // Rules for form validation
	            rules:
	            {
	                username:
	                {
	                    required: true,
                        minlength: 2,
                        maxlength: 20
	                },
	                /*email:
	                {
	                    required: true,
	                    email: true
	                },*/
	                password:
	                {
	                    required: true,
	                    minlength: 3,
	                    maxlength: 20
	                },
	                passwordConfirm:
	                {
	                    required: true,
	                    minlength: 3,
	                    maxlength: 20,
	                    equalTo: '#password'
	                },
	                firstname:
	                {
	                    required: true
	                },
	                lastname:
	                {
	                    required: true
	                },
	                terms:
	                {
	                    required: true
	                },
                    mobile:
                    {
                        required: true,
                        minlength: 11,
                        maxlength:11
                    },
                    mobile_code:{
                        required: true,
                        minlength: 4
                    }
	            },
	            
	            // Messages for form validation
	            messages:
	            {
                    username:
	                {
	                    required: '请输入用户名'
	                },
	                email:
	                {
	                    required: '请输入您的邮箱地址',
	                    email: '请输入有效的电子邮件地址'
	                },
	                password:
	                {
	                    required: '请输入密码'
	                },
	                passwordConfirm:
	                {
	                    required: '请再次输入密码',
	                    equalTo: '密码输入不一致'
	                },
	                firstname:
	                {
	                    required: '请输入你的名字'
	                },
	                lastname:
	                {
	                    required: '请选择你的性别'
	                },
	                terms:
	                {
	                    required: '你必须同意条款和条件'
	                },
                    mobile:
                    {
                        required: '请输入手机号码'
                    },
                    mobile_code:
                    {
                        required: '请输入验证码'
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