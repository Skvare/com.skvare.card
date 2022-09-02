# com.skvare.card

This Extension allows the admin to send Membership Cards to end users through regular email or as reminders in pdf format.


Site admin can design the card front and back side. You can keep css in separate sections for both sides.

**Create New Card**
![Screenshot](/images/card_new.png)

**Listing of Cards**
![Screenshot](/images/card_listing.png)

**Settings for Cards**
![Screenshot](/images/card_setting.png)

**Attach Membership card in Scheduled Reminder**
![Screenshot](/images/card_reminder.png)

## Requirements

* PHP v7.4+
* CiviCRM 5+

## Installation (Web UI)

This extension has not yet been published for installation via the web UI.

## Installation (CLI, Zip)

Sysadmins and developers may download the `.zip` file for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
cd <extension-dir>
cv dl com.skvare.card@https://github.com/skvare/com.skvare.card/archive/master.zip
```

## Installation (CLI, Git)

Sysadmins and developers may clone the [Git](https://en.wikipedia.org/wiki/Git) repo for this extension and
install it with the command-line tool [cv](https://github.com/civicrm/cv).

```bash
git clone https://github.com/skvare/com.skvare.card.git
cv en card
```

####Card Setting link : `civicrm/admin/setting/card`

####Card Listing link : `civicrm/admin/card/list`
