CREATE TABLE IF NOT EXISTS cotech.worker_sessions (
 id text PRIMARY KEY, user_id bigint REFERENCES cotech.users(id) ON DELETE CASCADE,
 csrf text NOT NULL, data jsonb NOT NULL DEFAULT '{}', expires_at timestamptz NOT NULL
);
CREATE INDEX IF NOT EXISTS worker_sessions_expires ON cotech.worker_sessions(expires_at);
CREATE TABLE IF NOT EXISTS cotech.worker_limits (key text PRIMARY KEY, hits integer NOT NULL, expires_at timestamptz NOT NULL);
CREATE TABLE IF NOT EXISTS cotech.worker_files (
 id uuid PRIMARY KEY, content_id bigint REFERENCES cotech.contents(id) ON DELETE CASCADE,
 media_id bigint REFERENCES cotech.media(id) ON DELETE CASCADE,
 name text NOT NULL, mime text NOT NULL, data bytea NOT NULL,
 CHECK ((content_id IS NOT NULL)::int + (media_id IS NOT NULL)::int = 1),
 CHECK (octet_length(data) <= 5242880)
);
CREATE TABLE IF NOT EXISTS cotech.worker_reset_tokens (
 token text PRIMARY KEY, user_id bigint NOT NULL REFERENCES cotech.users(id) ON DELETE CASCADE,
 expires_at timestamptz NOT NULL
);
CREATE TABLE IF NOT EXISTS cotech.worker_mail (
 id bigserial PRIMARY KEY, recipient text NOT NULL, subject text NOT NULL, body text NOT NULL,
 created_at timestamptz NOT NULL DEFAULT now(), sent_at timestamptz, attempts integer NOT NULL DEFAULT 0
);
