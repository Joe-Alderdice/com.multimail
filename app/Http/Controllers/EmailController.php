<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImportList;
use Maatwebsite\Excel\Facades\Excel;
use App\Contact;
use App\Imports\ContactsImport;
use App\Email;
use App\Mail\DefaultTemplate;
use App\User;
use Illuminate\Support\Facades\Mail;
Use Illuminate\Support\Facades\Auth;
Use Symfony\Component\HttpFoundation\Session\Session;

class EmailController extends Controller
{
    public function index()
{
        return view('email.index');
    }

    public function listCreate(Request $request, ImportList $importList)
    {
        $newList = new ImportList;

        $newList->name = $request->name;

        $newList->save();

        return redirect()->route('import');
    }

    public function import()
    {
        $lists = ImportList::all();
        return view('email.import', compact($lists, 'lists'));
    }

    public function importFile(Request $request, Contact $contact)
    {
        $csvRaw = $request->file;
        $csvArray = array_map('str_getcsv', file($csvRaw));
        $csv = array_slice($csvArray, 0, 2);

        foreach ($csv as $row) {
            $contact = new Contact;
            $contact->first_name = $row[0];
            $contact->last_name = $row[1];
            $contact->email = $row[2];
            $contact->list_id = $request->list_id;
            $contact->save();
        }

        return redirect()->route('template');
    }

    public function template()
    {
        $lists = ImportList::all();
        return view('email.template', compact($lists, 'lists'));
    }

    public function templateStore(Request $request, Email $email)
    {
        $email = new Email;

        $email->subject = $request->subject;
        $email->body = $request->body;
        $email->recipients_list = $request->recipients_list;

        $email->save();

        return redirect()->route('templatePreview');
    }

    public function templatePreview(Email $email)
    {

        //Gets the email to be previewed
        $rawEmail = Email::orderBy('created_at', 'desc')->limit(1)->get()[0];
        // Gets recipients list from email
        $recipientsList = $rawEmail->recipients_list;
        // Takes first user in recipients list
        $exampleUser = Contact::where('list_id', '=', $recipientsList)->limit(1)->get()[0];
        // Strings to be replaced in the email
        $toBeReplaced = array("1" => "%first_name%", "2" => "%last_name%");
        // Strings replacing the ones that need to be replaced
        $replacements = array("1" => $exampleUser->first_name, "2" => $exampleUser->last_name);
        // Function of replacing the strings, PHP function (String Replace)
        $emailSubject = str_replace($toBeReplaced, $replacements, $rawEmail->subject);
        $emailBody = str_replace($toBeReplaced, $replacements, $rawEmail->body);

        return view('email.preview', compact($emailSubject, 'emailSubject', $emailBody, 'emailBody', $rawEmail, 'rawEmail'));
    }

    public function send(Request $request)
    {
        $email = email::findOrFail($request->id);

        $recipients = Contact::where('list_id', '=', $email->recipients_list)->get();

        foreach($recipients as $recipient) {

        Mail::to($recipient)->send(new DefaultTemplate($email, $recipient));
        }

        return view('email.successful');

    }
}
