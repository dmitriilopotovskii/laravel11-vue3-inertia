declare namespace App.Data {
export type ProjectData = {
id: number | null;
name: string;
description?: string | null;
due_date?: string | null;
created_at?: string | null;
status?: number;
image_path?: string | null;
created_by: any | null;
updated_by: any | null;
};
}
