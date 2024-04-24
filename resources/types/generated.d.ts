declare namespace App.Data {
export type ProjectData = {
id: number | null;
name: string;
description?: string;
due_date?: string;
created_at?: string;
status?: string;
image_path?: string | null;
created_by?: any | null;
updated_by?: any | null;
tasks?: Array<App.Data.TaskData> | null;
};
export type TaskData = {
id: number | null;
name: string;
description?: string;
due_date?: string;
created_at?: string;
status?: string;
priority?: string;
image_path?: string | null;
created_by?: any | null;
updated_by?: any | null;
assigned_user?: any | null;
project?: App.Data.ProjectData | null;
};
}
declare namespace App.Enums {
export type ProjectStatus = 'pending' | 'in_progress' | 'completed';
}
