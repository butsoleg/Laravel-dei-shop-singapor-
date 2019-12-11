<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSend extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;

    public $from_email;
    public $from_name;
    public $to_name;
    public $amount;
    public $send_via;
    public $company;
    public $phone;
    public $url;
    public $fax;
    public $user_data;
    public $address;
    public $country;
    public $state;
    public $city;
    public $zipcode;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $content, $from_email = null, $from_name = null, $to_name = null, $amount = null, $send_via = null, $company = null, $phone = null, $url = null, $fax = null, $user_data = null, $address = null, $country = null, $state = null, $city = null, $zipcode = null)
    {
        //
        $this->subject = $subject;
        $this->content = $content;
        $this->from_email = $from_email;
        $this->from_name = $from_name;
        $this->to_name = $to_name;
        $this->amount = $amount;
        $this->send_via = $send_via;
        $this->company = $company;
        $this->phone = $phone;
        $this->url = $url;
        $this->fax = $fax;
        $this->user_data = '';
        $this->user_data = $user_data;
        $this->address = $address;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->zipcode = $zipcode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        if ( $this->subject == 'Vendor Register' ) {
           return $this->from($this->from_email, $this->from_name)
                        ->subject($this->subject)
                        ->view('emails.send_vendor_register', ['content' => $this->content, 'subject' => $this->subject, 'from_email' => $this->from_email, 'from_name' => $this->from_name, 'company' => $this->company, 'phone' => $this->phone, 'url' => $this->url, 'fax' => $this->fax, 'user_data' => $this->user_data, 'address' => $this->address, 'country' => $this->country, 'state' => $this->state, 'city' => $this->city, 'zipcode' => $this->zipcode]);
        }
        else if ( $this->subject == 'Contact Us' ) {
            return $this->from($this->from_email, $this->from_name)
                        ->subject($this->subject)
                        ->view('emails.send', ['content' => $this->content, 'subject' => $this->subject, 'from_email' => $this->from_email, 'from_name' => $this->from_name]);
        }
        else if ( $this->subject == 'Gift Certificates' ) {
            return $this->from($this->from_email, $this->from_name)
                        ->subject($this->subject)
                        ->view('emails.send_gift', ['content' => $this->content, 'subject' => $this->subject, 'from_email' => $this->from_email, 'from_name' => $this->from_name, 'send_via' => $this->send_via, 'to_name' => $this->to_name, 'amount' => $this->amount]);
        }
        else if ( $this->subject == 'Newsletter Signup' ) {
            return $this->from($this->from_email, $this->from_name)
                        ->subject($this->subject)
                        ->view('emails.newsletter', ['from_email' => $this->from_email]);
        }
        else {
            return $this->subject($this->subject)
                        ->view('emails.send', ['content' => $this->content, 'subject' => $this->subject, 'from_email' => $this->from_email, 'from_name' => $this->from_name]);
        }
    }
}
