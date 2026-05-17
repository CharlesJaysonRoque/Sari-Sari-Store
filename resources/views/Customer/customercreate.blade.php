@extends('index')

@section('content')
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">← Back</a>
    <h1>Add Customer</h1>
    <p>Fill in the form below to add a new customer to the system.</p>
    <div>
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            <div class="label-row">
                <label for="LastName">Lastname:</label>
                <p class="required">Required</p>
            </div>
            <input type="text" id="last_name" name="last_name" required>

            <div class="label-row">
                <label for="FirstName">Firstname:</label>
                <p class="required">Required</p>
            </div>
            <input type="text" id="first_name" name="first_name" required>

            <div class="label-row">
                <label for="MiddleName">Middlename:</label>
                <p class="optional">Optional</p>
            </div>
            <input type="text" id="middle_name" name="middle_name">

            <div class="label-row">
                <label for="ContactNumber">Contact Number:</label>
                <p class="required">Required</p>
            </div>
            <input
                type="tel"
                name="phone_number"
                required
                maxlength="11"
                pattern="09[0-9]{9}"
                title="Phone number must start with 09 and be 11 digits"
            />

            <input type="submit" value="Add Customer">
        </form>
    </div>



    <style>
        :root {
            --primary-color: #03a103;
            --primary-hover: #028002;

            --secondary-color: #555;
            --secondary-hover: #333;
        }
        .btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 5px 10px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: var(--secondary-hover);
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 500px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
        }
        input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: var(--primary-hover);
        }
        .required {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .optional {
            color: gray;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
@endsection
