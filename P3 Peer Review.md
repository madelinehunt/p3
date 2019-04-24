## P3 Peer Review

+ Reviewer's name: Nathaniel Hunt
+ Reviwee's name: Chiwen L.
+ URL to Reviewe's P3 Github Repo URL: *<https://github.com/iamwenz/p3>*

## 1. Interface

+ What are your initial impressions of the site interface?

Well, it's pretty barebones. Also, I did not expect there to be two pages. Once you do get to the second page, there's no way to get back to page 1 without messing with the URL.

+ Were there any parts of the interface that you found confusing, or did not work as you expected?

I did not expect the verification code to be right next to the text input. Also, the font has many ambiguous characters—I was originally given a code that appeared to be `mxll`, but I got an error message when I put that in the text input. Maybe it had been `mxII` instead.

I also did not expect a JavaScript alert when inputting the verification code. I especially did not expect it when the verification was successful.

+ Were there any parts of the interface that you thought worked notably well?

I like the use of whitespace. 

+ Do you have any suggestions for improvements on the interface?

Choosing a clearer font, for one. And a "back" button on page 2. Also, the error messages seem to be shouting at me—they're in all caps, with exclamation points. Get rid of the JavaScript alerts—they're unneccesary, and make getting to the appointment form a slog involving several clicks. 

The open-text field on the appointment form should be labeled—after submitting it, I saw that it was intended for me to describe symptoms? That was very unclear. 

"Please select" should not be an active, selectable option in the Female/Male `<select>` field. The `disabled` attribute should be set. 


## 2. Functional testing

Submitting a form with no data displays the appropriate error messages. HTML validation is used on the "age" field, though it should limit user input to only two digits if that's what's required (instead of giving the user an error message after the fact). The `min` and `max` attributes would be more user-friendly here. 

Practice Controller and `'/practice/{title}'` route are still present and active in this application. 

The verification code on the first page is not very functional, because the user can simply visit the `'/register'` URL and bypass the verification process. 

Note: when the form has an error, it does not pre-fill all fields when displaying error messages. 


## 3. Code: Routes
Routing looks good—It's all very simple, routing URL requests to the appropriate method of the `FormController`.

## 4. Code: Views

+ Is template inheritance used?

Yes. The views extend `layouts/master`.

+ Are there any separation of concern issues (i.e. non-display specific logic in view files)?

Nope! Separation of concerns looks good. 

+ Did they do anything in PHP that could have been done in Blade?

No, it's all Blade. 

+ Did they use any Blade syntax/techniques you were unfamiliar with?

No, it was all familiar. 

## 5. Code: General

+ Do you notice any inconsistencies between the code and the course notes on [code style](https://github.com/susanBuck/dwa15-fall2018/blob/master/misc/code-style.md)?

Yes, one minor one: function declarations have the opening brace on the same line as the function name, instead of on the following line. Other code style departures were notated in the readme.

+ Are there any best practices discussed in course material that you feel were not addressed in the code?

Nope.

+ Are there aspects of the code that you feel were not self-evident and would benefit from comments?

It seems pretty self-explanatory.

+ Are there any parts of the code that you found interesting/would not have thought to do yourself?

I thought it was interesting that Chiwen used 

```
return view('confirm')->with([
        'species'=>$request->session()->get('species',''),
        'age'=>$request->session()->get('age',''),
        'gender'=>$request->session()->get('gender',''),
        'visited'=>$request->session()->get('visited',''),
        'symptom'=>$request->session()->get('symptom',''),
      ]);
```

I hadn't though to use the session data like that. 

+ Are there any parts of the code that you don't understand?

No—it was laid out pretty clearly. 

## 6. Misc
Do you have any additional comments not covered in the above questions?

No. 