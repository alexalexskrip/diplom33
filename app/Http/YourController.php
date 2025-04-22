namespace App\Http\Controllers;

use App\Models\YourModel; // Импортируйте вашу модель
use Illuminate\Http\Request;

class YourController extends Controller
{
    public function edit($id)
    {
        $data = YourModel::findOrFail($id);
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'field1' => 'required|max:255',
            'field2' => 'required',
            // добавьте другие правила валидации
        ]);

        $data = YourModel::findOrFail($id);
        $data->field1 = $request->input('field1');
        $data->field2 = $request->input('field2');
        // обновите другие поля
        $data->save();

        return redirect()->route('some.route')->with('success', 'Данные успешно обновлены!');
    }
}