import fs from "node:fs";
import { spawn } from "node:child_process";
const db = JSON.parse(
    fs.readFileSync("storage/app/private/deploy/worker-db.json", "utf8"),
);
const uri = new URL("postgresql://" + db.host + ":5432/" + db.database);
uri.username = db.user;
uri.password = db.password;
uri.searchParams.set("sslmode", "require");
const child = spawn(
    process.execPath,
    [
        "node_modules/wrangler/bin/wrangler.js",
        "dev",
        "--port",
        "8787",
        "--ip",
        "127.0.0.1",
    ],
    {
        stdio: "inherit",
        env: {
            ...process.env,
            CLOUDFLARE_HYPERDRIVE_LOCAL_CONNECTION_STRING_HYPERDRIVE: uri.href,
        },
    },
);
child.on("exit", (code) => process.exit(code || 0));
