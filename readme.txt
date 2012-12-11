This web application implements a simple social network focused on music that supports functionalities for adding friends and liking various artists and songs. Users can add and edit their profile, view the profiles of and friend other users, send messages to other users, look up and like artists, and look up basic usage statistics of the site.

We handle actions by using get and post requests with php, along with keeping track of the current user within a given session. For example, when a profile is viewed, a get request is sent for the requesting user's profile. If this user matches the current logged in user as defined by the session, then extra fields are displayed such as the message box and friends requests.

Some things we did not implement:
List all songs/List songs by attribute- songs are listed by artist in the corresponding artist page.
List all of the users under 30 employed at a company- Company's did not store enough data to warrant their own page so all the data was migrated to the user profile. Because of this, this query didn't have a good place to put in the site.
List all users in a certain town/state- Addresses are stored as a string so there was no simple way to extract this data. In order to fix we would have to add more columns to the db for each field for every user.
