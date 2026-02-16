-- ========================
-- USERS
-- ========================
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================
-- FESTIVALS
-- ========================
CREATE TABLE IF NOT EXISTS festivals (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    start_date DATE,
    end_date DATE,
    location VARCHAR(150),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================
-- EVENTS
-- ========================
CREATE TABLE IF NOT EXISTS events (
    id SERIAL PRIMARY KEY,
    festival_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    event_date TIMESTAMP,
    venue VARCHAR(150),
    entry_fee NUMERIC(10,2),
    max_participants INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_festival
        FOREIGN KEY (festival_id)
        REFERENCES festivals(id)
        ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_events_festival_id
ON events(festival_id);

-- ========================
-- TICKETS
-- ========================
CREATE TABLE IF NOT EXISTS tickets (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    status VARCHAR(20) DEFAULT 'booked',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_ticket_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE,
    CONSTRAINT fk_ticket_event
        FOREIGN KEY (event_id)
        REFERENCES events(id)
        ON DELETE CASCADE
);

CREATE INDEX IF NOT EXISTS idx_tickets_user_id ON tickets(user_id);
CREATE INDEX IF NOT EXISTS idx_tickets_event_id ON tickets(event_id);

-- ========================
-- PAYMENTS (OPTIONAL)
-- ========================
CREATE TABLE IF NOT EXISTS payments (
    id SERIAL PRIMARY KEY,
    ticket_id INT NOT NULL,
    amount NUMERIC(10,2),
    payment_mode VARCHAR(20),
    status VARCHAR(20) DEFAULT 'success',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payment_ticket
        FOREIGN KEY (ticket_id)
        REFERENCES tickets(id)
        ON DELETE CASCADE
);

-- ========================
-- VOLUNTEERS
-- ========================
CREATE TABLE IF NOT EXISTS volunteers (
    id SERIAL PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    task VARCHAR(100),
    status VARCHAR(20) DEFAULT 'assigned',
    added_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_volunteer_user
        FOREIGN KEY (added_by)
        REFERENCES users(id)
        ON DELETE SET NULL
);

-- ========================
-- DONATIONS
-- ========================
CREATE TABLE IF NOT EXISTS donations (
    id SERIAL PRIMARY KEY,
    donor_name VARCHAR(150),
    amount NUMERIC(10,2) NOT NULL,
    mode VARCHAR(20) DEFAULT 'offline',
    note VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ========================
-- API TOKENS
-- ========================
CREATE TABLE IF NOT EXISTS api_tokens (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_token_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

