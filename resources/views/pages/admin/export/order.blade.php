<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<body>
  <table>
    <thead>
      <tr>
        <th align="center" style=" border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">ID</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Payment Type</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Duration</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Price</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Start Time</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">End Time</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Note</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Platform</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Package Price</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Package Hour</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Package Minute</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Member Name</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Member Phone</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Member Gender</th>
        <!-- <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Member Birth Date</th> -->
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;">Member Vip</th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;"></th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;"></th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;"></th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;"></th>
        <th align="center" style="border: 1px solid black; border-collapse: collapse; background-color: #96D4D4; font-weight: bold;"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->payment_type }}</td>
        <td>{{ $order->duration }}</td>
        <td>{{ $order->price }}</td>
        <td>{{ $order->start_time }}</td>
        <td>{{ $order->end_time }}</td>
        <td>{{ $order->formatted_note }}</td>
        <td>{{ $order->platform }}</td>
        <td>{{ $order->samplePackage->price }}</td>
        <td>{{ $order->samplePackage->hour }}</td>
        <td>{{ $order->samplePackage->minute }}</td>
        <td>{{ $order->sampleMember->name }}</td>
        <td>{{ $order->sampleMember->phone }}</td>
        <td>{{ $order->sampleMember->gender }}</td>
        <td>{{ $order->sampleMember?->birth_date }}</td>
        <td>{{ $order->sampleMember->is_vip }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>