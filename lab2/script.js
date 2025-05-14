function validateForm() {
    const name = document.getElementById('name').value.trim();
    const father = document.getElementById('father').value.trim();
    const address = document.getElementById('address').value.trim();
    const gender = document.querySelector('input[name="gender"]:checked');
    const city = document.getElementById('city').value;
    const course = document.getElementById('course').value;
    const pincode = document.getElementById('pincode').value.trim();
    const email = document.getElementById('email').value.trim();
    const dob = document.getElementById('dob').value;
    const mobile = document.getElementById('mobile').value.trim();
  
    if (!name || !father || !address) {
      alert('Name, Father Name, and Address are required.');
      return false;
    }
  
    if (!gender) {
      alert('Please select a gender.');
      return false;
    }
  
    if (!city) {
      alert('Please select a city.');
      return false;
    }
  
    if (!course) {
      alert('Please select a course.');
      return false;
    }
  
    if (!/^\d{4}$/.test(pincode)) {
      alert('PinCode must be exactly 4 digits.');
      return false;
    }
  
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert('Please enter a valid email address.');
      return false;
    }
  
    if (!dob) {
      alert('Please enter your date of birth.');
      return false;
    }
  
    const age = calculateAge(dob);
    if (age < 18) {
      alert('You must be at least 18 years old.');
      return false;
    }
  
    if (!/^\d{10}$/.test(mobile)) {
      alert('Mobile number must be exactly 10 digits.');
      return false;
    }
  
    alert('Form submitted successfully!');
    return true;
  }
  
  function calculateAge(dob) {
    const birthDate = new Date(dob);
    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();
    const m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
      age--;
    }
    return age;
  }
  