<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use IanLChapman\PigLatinTranslator\Parser;
use App\Participant;
use App\Study;

class PracticeController extends Controller
{
    /**
     * Week 11 - DELETE example
     */

     private $gender_choices = [
        'Male',
        'Female',
        'Non-binary',
        'Decline'
    ];
    private $race_choices = [
        'American Indian or Alaska Native',
        'Asian',
        'Black or African-American',
        'Native Hawaiian or Other Pacific Islander',
        'White',
        'Other',
        'Multi-ethnic',
        'Decline',
    ];
    private $ethn_choices = [
        'Hispanic',
        'Not Hispanic',
        'Decline',
    ];

    private $validation_rules = [
        'id_code' => [
            'required',
            'alpha_num',
            'max:16'
        ],
        'age' => [
            'required',
            'max:120',
            'numeric',
            'min:18'
        ]
    ];

     public function practice3()
     {
         return view('create_or_edit')->with([
             'page_opts' => [
                 'form_type' => 'participant',
                 'action_type' => 'add',
                 'header_text' => 'Add a participant to the database',
                 'button_label' => 'Add participant',
                 'title_text' => 'Add a participant to the database',
             ],
            'gender_choices' => $this->gender_choices,
            'race_choices' => $this->race_choices,
            'ethn_choices' => $this->ethn_choices,
         ]);
     }

    public function practice2()
    {
        return view('create_or_edit')->with([
            'page_opts' => [
                'form_type' => 'study',
                'action_type' => 'add',
                'header_text' => 'Add a study to the database',
                'button_label' => 'Add study',
                'title_text' => 'Add a study to the database',
            ],
        ]);
    }

    public function practice1()
    {
        # First get a book to delete
        $study = Participant::get()->first();
        dd($study->studies->toArray());
        if (!$book) {
            dump('Did not delete- Book not found.');
        } else {
            $book->delete();
            dump('Deletion complete; check the database to see if it worked...');
        }
    }
    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://foobooks.loc/practice => Shows a listing of all practice routes
     * http://foobooks.loc/practice/1 => Invokes practice1
     * http://foobooks.loc/practice/5 => Invokes practice5
     * http://foobooks.loc/practice/999 => 404 not found
     */
    public function index($n = null)
    {
        $methods = [];
        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1
            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method() : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }
            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}
