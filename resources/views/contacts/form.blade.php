@php
    // Define default values in case $contact is not set
    $defaultValues = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'street_address' => '',
        'image' => '',
        'city' => '',
        'state' => 'CA', // Default state
        'country' => 'US', // Default country
    ];
    $values = isset($contact) ? $contact->toArray() : $defaultValues;
@endphp

<div class="form-group">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $values['name']) }}"
        required>
    @error('name')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone" class="form-control"
        value="{{ old('phone', $values['phone']) }}" required>
    @error('phone')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control"
        value="{{ old('email', $values['email']) }}" required>
    @error('email')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image:</label>
    <input type="file" name="image" id="image" class="form-control"
        value="{{ old('image', $values['image']) }}" >
    @error('image')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="street_address">Street Address:</label>
    <input type="text" name="street_address" id="street_address" class="form-control"
        value="{{ old('street_address', $values['street_address']) }}" required>
    @error('street_address')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="city">City:</label>
    <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $values['city']) }}"
        required>
    @error('city')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="state">State:</label>
    <select name="state" id="state" class="form-control" required>
        <option value="CA" {{ old('state', $values['state']) == 'CA' ? 'selected' : '' }}>CA</option>
        <option value="NY" {{ old('state', $values['state']) == 'NY' ? 'selected' : '' }}>NY</option>
        <option value="AT" {{ old('state', $values['state']) == 'AT' ? 'selected' : '' }}>AT</option>
    </select>
    @error('state')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="country">Country:</label>
    <select name="country" id="country" class="form-control" required>
        <option value="IN" {{ old('country', $values['country']) == 'IN' ? 'selected' : '' }}>IN</option>
        <option value="US" {{ old('country', $values['country']) == 'US' ? 'selected' : '' }}>US</option>
        <option value="EU" {{ old('country', $values['country']) == 'EU' ? 'selected' : '' }}>EU</option>
    </select>
    @error('country')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
    @enderror
</div>
