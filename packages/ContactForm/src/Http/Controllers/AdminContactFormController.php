<?php

namespace ContactForm\Http\Controllers;

use ContactForm\Models\ContactForm;
use Illuminate\Http\Request;

class AdminContactFormController extends \App\Http\Controllers\Controller
{
    public function index(Request $request)
    {

        $query = ContactForm::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $submissions = $query->orderBy('created_at', 'desc')->get();
        return view('contactform::admin.index', compact('submissions'));
    }

    public function show(ContactForm $contactForm)
    {
        return view('contactform::admin.show', compact('contactForm'));
    }

    public function destroy(ContactForm $contactForm)
    {
        $contactForm->delete();
        return redirect()->back()->with('success', 'Submission deleted successfully.');
    }
}
