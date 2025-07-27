<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h1 class="mt-3">Good day,</h1>
    <div class="mb-3">
        <br />
        <p>You have been registered to BCP System.</p>
        <br>
        <p>Below is your login credential:</p>
    </div>
    <div class="mt-2">
        <p>Name: {{ $details['name'] }}</p>
        <p>Username: {{ $details['username'] }}</p>
        <p>Email: {{ $details['email'] }}</p>
        <p>Password: {{ $details['password'] }}</p>
        <br>
        <p>User Role: {{ ucwords($details['role']) }}</p>
    </div>
    <div class="mt-3">
        <p>Thanks!</p>
    </div>
</body>
</html>
