<h1 style="font-family: DejaVu Sans, sans-serif; text-align: center;">Список книг:</h1>
<table style="border: 1px solid black; font-family: DejaVu Sans, sans-serif; width: 100%; border-collapse: collapse;">
    <tr>
        <th style="border: 1px solid black; padding: 20px; text-align: center; color: red">Назва книги</th>
        <th style="border: 1px solid black; padding: 20px; text-align: center; color: red">Автор</th>
    </tr>
    @foreach($books as $book)
    <tr style="border: 1px solid black; width: 100%">
        <td style="border: 1px solid black; padding: 20px; text-align: center;">{{ $book->name }}</td>
        <td style="border: 1px solid black; padding: 20px; text-align: center;">{{ $book->author->authorName }}</td>
    </tr>
    @endforeach
</table>
