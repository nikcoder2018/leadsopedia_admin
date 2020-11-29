<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Title</th>
        <th>Company</th>
        <th>Category</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Website</th>
        <th>Address</th>
        <th>Linkedin</th>
        <th>Facebook</th>
        <th>Messenger</th>
        <th>Instagram</th>
        <th>Twitter</th>
        <th>Google Search</th>
        <th>Google Map</th>
      </tr>
      </thead>
      <tbody>
        @php $counter = 1; @endphp
        @foreach ($leads as $lead)
        <tr>
            <td>{{ $counter++ }}</td>
            <td>{{ $lead->first_name }}</td>
            <td>{{ $lead->last_name }}</td>
            <td>{{ $lead->title }}</td>
            <td>{{ $lead->company_name }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ $lead->phone }}</td>
            <td>{{ $lead->website }}</td>
            <td>{{ $lead->address }},{{ $lead->city }},{{ $lead->country }}</td>
            <td>{{ $lead->linkedin }}</td>
            <td>{{ $lead->facebook }}</td>
            <td>{{ $lead->messenger }}</td>
            <td>{{ $lead->instagram }}</td>
            <td>{{ $lead->twitter }}</td>
            <td>{{ $lead->google_search }}</td>
            <td>{{ $lead->google_map }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>