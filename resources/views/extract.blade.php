<table>
    <thead>
    <tr>
    @foreach ($results[0] as $key => $value)
        <td>{{ $key }}</td>
    @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $raw => $line)
        <tr>
        @foreach ($line as $key => $value)
            <td>{{ $value }}</td>
        @endforeach
        </tr>
    @endforeach
    </tbody>
</table>