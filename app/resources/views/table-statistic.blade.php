<table border="2" cellpadding="4">
    <tr>
        <th>Job</th>
        <th>Count</th>
    </tr>
    <tr>
        <td>Current jobs urgent</td>
        <td>{{ $pheanstalkStatus['current-jobs-urgent'] }}</td>
    </tr>
    <tr>
        <td>current-jobs-ready</td>
        <td>{{ $pheanstalkStatus['current-jobs-ready'] }}</td>
    </tr>
    <tr>
        <td>current-jobs-reserved</td>
        <td>{{ $pheanstalkStatus['current-jobs-reserved'] }}</td>
    </tr>
    <tr>
        <td>current-jobs-delayed</td>
        <td>{{ $pheanstalkStatus['current-jobs-delayed'] }}</td>
    </tr>
    <tr>
        <td>current-jobs-buried</td>
        <td>{{ $pheanstalkStatus['current-jobs-buried'] }}</td>
    </tr>
</table>
