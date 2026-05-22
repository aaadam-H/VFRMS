# VFRMS

**VFRMS** (presumably "Virtual Event Registration and Management System") is a web application designed to manage and facilitate event creation, registration, and participation. Built primarily using HTML, PHP, SCSS, and CSS, the system supports both event organizers and participants with dedicated functionality.

---

## Features

### For Event Organizers
- **Event Creation**: Organizers can create events with custom descriptions, registration periods, fees, and display images.
- **Participant Management**: View registered participants per event and manage event status.
- **Statistics & Analytics**: Get insights on total events, participants, and financial statistics per year.
- **Profile Management**: Organizers can update their profile and contact info.

### For Participants
- **Event View & Registration**: Browse ongoing events, register, and view event details.
- **My Events**: Track events they are registered for, including status (ongoing/completed).
- **Upload Proof**: Participants may upload proof documents or images as part of the event process.
- **Profile Management**: Update username, email, and contact number.

---

## Tech Stack

| Language        | Percent |
|-----------------|---------|
| HTML            | 70.1%   |
| PHP             | 12.8%   |
| SCSS            | 11.7%   |
| CSS             | 5.2%    |
| Other           | 0.2%    |

The backend runs on PHP and connects to a database to store events and user data. The frontend uses HTML, SCSS, and CSS for interface and styling.

---

## Directory Structure (Partial)
```
- css/                # Stylesheets and theme
- fonts/              # Icon and font files
- img/                # Images used in interface
- js/                 # JavaScript libraries and scripts
- imageProof/         # Uploaded proofs for events
- home.php            # Main dashboard (landing page after login)
- createEvent.php     # For event organizers to add new events
- myEvent.php         # User-specific event listing (registered or organized)
- stats.php           # Statistics and analytics dashboard
- profile.php         # User profile view and edit
- connection.php      # Database connection script
```

---

## Getting Started

1. **Clone the repository**
   ```bash
   git clone https://github.com/aaadam-H/VFRMS.git
   ```

2. **Set up your environment**
   - Requires PHP (7.x or newer) and a web server (e.g., Apache).
   - Install and configure a MySQL database.
   - Update `connection.php` for your database credentials.

3. **Run the application**
   - Serve the root directory via your local or remote web server.
   - Access `home.php` through your browser.
   - Register as a user or login as an organizer to start managing events.

---

## Screenshots

<sup>Add screenshots here to showcase dashboard, event creation, and registration pages.</sup>

---

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project currently does not specify a license.

---

## Contact

- **Repository:** [https://github.com/aaadam-H/VFRMS](https://github.com/aaadam-H/VFRMS)
- **Maintainer:** [aaadam-H](https://github.com/aaadam-H)
