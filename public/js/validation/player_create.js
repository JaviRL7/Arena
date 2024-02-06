function playerData() {
    return {
        name: '',
        lastname1: '',
        lastname2: '',
        nick: '',
        country: '',
        birth_date: '',
        role_id: '',
        role_name: '',
        photoData: '',
        imgData: '',
        photoPreview(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoData = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        imgPreview(event) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imgData = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        updateRoleName(event) {
            const selectedRole = this.$refs.roleSelect.options[this.$refs.roleSelect.selectedIndex];
            this.role_name = selectedRole.text;
        }
    }
}
document.getElementById('playerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const name = document.getElementById('name').value;
    const lastname1 = document.getElementById('lastname1').value;

    const lastname2 = document.getElementById('lastname2').value;

    const nick = document.getElementById('nick').value;
    const country = document.getElementById('country').value;


    const birth_date = document.getElementById('birth_date').value;
    const photo = document.getElementById('photo').files.length;
    const img = document.getElementById('img').files.length;

    const digitPattern = /\d/;
    const specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/g;
    const spacePattern = /\s/;

    let isValid = true;

    if (digitPattern.test(name) || specialCharPattern.test(name) || spacePattern.test(name)) {
        document.getElementById('nameError').textContent = 'Name cannot contain digits, special characters or spaces.';
        isValid = false;
    } else {
        document.getElementById('nameError').textContent = '';
    }

    if (digitPattern.test(lastname1) || specialCharPattern.test(lastname1) || spacePattern.test(lastname1)) {
        document.getElementById('lastname1Error').textContent = 'First Lastname cannot contain digits, special characters or spaces.';
        isValid = false;
    } else {
        document.getElementById('lastname1Error').textContent = '';
    }


    if (nick.length < 3 || nick.length > 15) {
        document.getElementById('nickError').textContent = 'Nick must be between 3 and 15 characters.';
        isValid = false;
    } else {
        document.getElementById('nickError').textContent = '';
    }

    if (digitPattern.test(country)) {
        document.getElementById('countryError').textContent = 'Country cannot contain digits.';
        isValid = false;
    } else {
        document.getElementById('countryError').textContent = '';
    }


    if (lastname2 && (digitPattern.test(lastname2) || specialCharPattern.test(lastname2) || spacePattern.test(lastname2))) {
        document.getElementById('lastname2Error').textContent = 'Second Lastname cannot contain digits, special characters or spaces.';
        isValid = false;
    } else {
        document.getElementById('lastname2Error').textContent = '';
    }
    if (!birth_date) {
        document.getElementById('birthDateError').textContent = 'Birth Date must be selected.';
        isValid = false;
    } else {
        document.getElementById('birthDateError').textContent = '';
    }

    if (photo === 0) {
        document.getElementById('photoError').textContent = 'A photo must be selected.';
        isValid = false;
    } else {
        document.getElementById('photoError').textContent = '';
    }

    if (img === 0) {
        document.getElementById('imgError').textContent = 'An image must be selected.';
        isValid = false;
    } else {
        document.getElementById('imgError').textContent = '';
    }
    if (isValid) {
        event.target.submit();
    }
});
