<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css" />
        <title>Currency</title>
    </head>
    <body>
      
          <table class="tabelaKurs">
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Currency code</th>
              <th>Exchange rate</th> 
            </tr>
            @foreach ($currency as $c)
               <tr>
                  <td>{{ $c->id }}</td>
                  <td>{{ $c->name }}</td>
                  <td>{{ $c->currency_code }}</td>
                  <td>{{ $c->exchange_rate }}</td>
              </tr>
            @endforeach
          </table>

    </body>
</html>
