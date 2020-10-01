$(document).ready(function()
{
	var ageCalc = $("#age").val();
	ageCalc = new Date(ageCalc);
	var today = new Date();
	var res = Math.floor((today-ageCalc)/ (365.25 * 24 * 60 * 60 * 1000));
	$("#age").val(res);
	$("#calculate_cvd").on('click', function()
	{
		$('#calculate_cvd_div').dialog({
          autoOpen: false, 
          hide: "puff",
          show : "slide",
          width: '800px',
          modal: true
		});
		$( "#calculate_cvd_div" ).dialog( "open" );
		//console.log($('input[name="gender"]:checked').val());
		$("#calculate_add").on('click', function()
		{
			var genderVal = 0;
			var smokerVal = 0;
			var diabetesVal = 0;
			var lvhVal = 0;

			var time_period = $("#time_period").val();
			var gender = $("#gender").val();
			var age = $("#age").val();
			var smoker = $("#smoker").val();
			var systolic = $("#sbp").val();
			var total_chol = $("#total_chol").val();
			var hdl_chol = $("#hdl_chol").val();
			var diabetes = $("#diabetes").val();
			var lvh = $("#lvh").val();
			if(time_period == "" || time_period<4 || time_period>12)
			{
				$("#time_period").css('border-color', 'red');
				$("#time_period").focus();
			}

			else if(systolic == "" || systolic == 0)
			{
				$("#sbp").css('border-color', 'red');
				$("#sbp").focus();
			}

			else if(total_chol == "" || total_chol == 0)
			{
				$("#total_chol").css('border-color', 'red');
				$("#total_chol").focus();
			}
			
			else if(hdl_chol == "" || hdl_chol == 0)
			{
				$("#hdl_chol").css('border-color', 'red');
				$("#hdl_chol").focus();
			}

			else if(diabetes == "select")
			{
				$("#diabetes").css('border-color', 'red');
				$("#diabetes").focus();
			}

			else if(lvh == "select")
			{
				$("#lvh").css('border-color', 'red');
				$("#lvh").focus();
			}
			else
			{
				$("#time_period").css('border-color', '#0090ff');
				$("#sbp").css('border-color', '#0090ff');
				$("#total_chol").css('border-color', '#0090ff');
				$("#hdl_chol").css('border-color', '#0090ff');
				$("#diabetes").css('border-color', '#0090ff');
				$("#lvh").css('border-color', '#0090ff');

				if(gender == "Male")
				{
					genderVal = 1;

				}
				else
				{
					genderVal = 0;
				}
				if(smoker == "Yes")
				{
					smokerVal = 1;
				}
				else
				{
					smokerVal = 0;
				}
				if(diabetes == "yes")
				{
					diabetesVal = 1;
				}
				else
				{
					diabetesVal = 0;
				}
				if(lvh == "yes")
				{
					lvhVal = 1;
				}
				else
				{
					lvhVal = 0;
				}

				//Formula Calculation
				// var framingham = 100*(1-Math.exp(-Math.exp((Math.log(time_period)-(18.8144+(-1.2146*(1-genderVal))+(-1.8443*Math.log(age))+(0*Math.log(age)*Math.log(age))+(0.3668*Math.log(age)*(1-genderVal))
				// 	+(0*Math.log(age)*Math.log(age)*(1-genderVal))+(-1.4032*Math.log(systolic))+(-0.3899*smokerVal)+(-0.539*Math.log(total_chol/hdl_chol))
				// 	+(-0.3036*diabetes)+(-0.1697*diabetesVal*(1-genderVal))+(-0.3362*lvhVal)+(0*lvhVal*genderVal)))/(Math.exp(0.6536)
				// 	*Math.exp(-0.2402*(18.8144+(-1.2146*(1-genderVal))+(-1.8443*Math.log(age))
				// 	+(0*Math.log(age)*Math.log(age))+(0.3668*smokerVal)+(-0.539*Math.log(total_chol/hdl_chol))
				// 	+(-0.3036*diabetesVal)+(-0.1697*diabetesVal*(1-genderVal))
				// 	+(-0.3362*lvhVal)+(0*lvhVal*genderVal)))))));
				var var13 = -1.2146*(1-genderVal);
				var var14 = -1.8443*Math.log(age);
				var var1 = (18.8144+(var13)+(var14)
					+(0*Math.log(age)*Math.log(age))+(0.3668*smokerVal)+(-0.539*Math.log(total_chol/hdl_chol))+(-0.3036*diabetesVal)+(-0.1697*diabetesVal*(1-genderVal))+(-0.3362*lvhVal));
				var var2 = (Math.exp(0.6536)
					*Math.exp(-0.2402*var1));
				var var5 = (-1.2146*(1-genderVal));
				var var6 = -1.8443*Math.log(age);
				var var7 = 0*Math.log(age)*Math.log(age);
				var var8 = 0.3668*Math.log(age)*(1-genderVal);
				var var9 = 0*Math.log(age)*Math.log(age)*(1-genderVal);
				var var4 = 18.8144+var5+(var6)+(var7)+(var8);
				var var10 = -1.4032*Math.log(systolic);
				var var11 = -0.3899*smokerVal;
				var var12 = -0.539*Math.log(total_chol/hdl_chol);
					+(var9)+(var10)+(var11)+(var12)
					+(-0.3036*diabetes)+(-0.1697*diabetesVal*(1-genderVal))+(-0.3362*lvhVal)+(0*lvhVal*genderVal);
				var var3 = (Math.log(time_period)-var4)/var2;
				var var15 = -Math.exp(var3);
				var framingham = 100*(1-Math.exp(var15));
				console.log(var13);
				console.log(var14);
				console.log(var1);
				console.log(var2);
				console.log(var5);
				console.log(var6);
				console.log(var7);
				console.log(var8);
				console.log(var9);
				console.log(var10);
				console.log(var11);
				console.log(var12);
				console.log(var4);
				console.log(var3);
				console.log(var15);
				console.log(framingham);
			}
		});
	})
})