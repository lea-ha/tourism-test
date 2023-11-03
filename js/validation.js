const validation = new JustValidate("#sgnup");
console.log("Validation object created");
validation.addField("#first_name",[{
    rule: "required"
}]).addField("#last_name",[{
    rule: "required"
}]).addField("#phone_number",[{
    rule: "required"
}])
.addField("#email", [{
    rule: "required"
},{
    rule:"email"
},{
    validator: (value) => () => {
        return fetch("validate-email.php?email="+encodeURIComponent(value)).then(function(response){
            return response.json();
        }).then(function(json){
            return json.available;
        });
    },
    errorMessage: "email already exists"
}]).addField("#password", [{
    rule:"required"
},{
    rule:"password"
}]).addField("#password-re", [{
    validator: (value, fields)=>{
        return value === fields["#password"].elem.value;
    },
    errorMessage: "Passwords should match"
}]).onSuccess((event)=>{
    document.getElementById("sgnup").submit();
});