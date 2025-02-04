#Laravel Course

#Got this course from Bitfumes Youtube channel

<!-- Project Idea -->
#User can create ticket
#Admin can reply on help ticket
#Admin can reject or resolve ticket
#When admin updated user will get notified via email ticket status is updated.
#User can give ticket title and description
#User can upload a document pdf & img

<!-- Table Structure -->

#Ticket-
 title(string),{req}
 description(text),{req}
 status(open{default}, resoleve, rejected), 
 attachments(string),{nullable}
 user_id, {req} filled by laravel
 status_changed_by_id {nullable}

#Replies table - 
body(text), {req}
user_id, {req} filled by laravel
ticket_id {req} filled by laravel