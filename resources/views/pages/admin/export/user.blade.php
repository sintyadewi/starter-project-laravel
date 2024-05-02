<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
  <table>
    <thead>
      <tr>
        <th align="center" style=" border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Name</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Email</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>