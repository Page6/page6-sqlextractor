<html>
	<head>
		<title>数据提取</title>
	</head>
	<body>
		<table border=1>
			<tr>
				<td>ID号</td>
				<td>姓名</td>
				<td>年龄</td>
				<td>职位</td>
			</tr>
			@foreach ($employees as $employee)
			<tr>
				<td>{{ $employee->id }}</td>
				<td>{{ $employee->name }}</td>
				<td>{{ $employee->age }}</td>
				<td>{{ $employee->position }}</td>
			</tr>
			@endforeach
		</table>
	</body>
</html>