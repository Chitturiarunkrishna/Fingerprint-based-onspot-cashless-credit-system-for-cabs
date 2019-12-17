function varargout = enrol(varargin)

gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @enrol_OpeningFcn, ...
                   'gui_OutputFcn',  @enrol_OutputFcn, ...
                   'gui_LayoutFcn',  [] , ...
                   'gui_Callback',   []);
if nargin && ischar(varargin{1})
    gui_State.gui_Callback = str2func(varargin{1});
end

if nargout
    [varargout{1:nargout}] = gui_mainfcn(gui_State, varargin{:});
else
    gui_mainfcn(gui_State, varargin{:});
end
function enrol_OpeningFcn(hObject, eventdata, handles, varargin)
handles.output = hObject;
guidata(hObject, handles);
function varargout = enrol_OutputFcn(hObject, eventdata, handles) 
varargout{1} = handles.output;
function t_name_Callback(hObject, eventdata, handles)
function t_name_CreateFcn(hObject, eventdata, handles)
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end
function t_age_Callback(hObject, eventdata, handles)
function t_age_CreateFcn(hObject, eventdata, handles)
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end
function b_enroltodb_Callback(hObject, eventdata, handles)
name = get(handles.t_name, 'string');
age = get(handles.t_age, 'String');
path1 = get(handles.t_f1, 'string');
path2 = get(handles.t_f2, 'string');
set(hObject, 'String', 'Enrolling... ');
drawnow();
% inserting the values into database
fprintf(['>> Entering values into database... ']);
load database person minutiae

ind = regexp(path1, '[0-9][0-1][0-8]_[0-8]');
id1 = path1(ind:ind+4);
ind = regexp(path2, '[0-9][0-1][0-8]_[0-8]');
id2 = path2(ind:ind+4);

rec1 = struct('Name', name, 'Age', age, 'FID1', id1, 'FID2', id2);

[r] = size(person);
temp_struct = table2struct(person);

if r == 0
    temp_struct = rec1;
else
    temp_struct = [temp_struct; rec1];
end;

person = struct2table(temp_struct);

save database person minutiae

set(hObject, 'String', 'Extracting minutiae of first finger...');
drawnow();

if path1~=0
    minu1 = ext_finger(imread(path1));
    minu1 = num2cell(minu1);
    minu1 = struct('ID', id1, 'X', minu1(:, 1), 'Y', minu1(:, 2),...
                   'Type', minu1(:, 3), 'Angle', minu1(:, 4), ...
                   'S1', minu1(:, 5), 'S2', minu1(:, 6));
end;

set(hObject, 'String', 'Extracting minutiae of second finger...');
drawnow();
if path2~=0
    minu2 = ext_finger(imread(path2));
    minu2 = num2cell(minu2);
    minu2 = struct('ID', id2, 'X', minu2(:, 1), 'Y', minu2(:, 2),...
                   'Type', minu2(:, 3), 'Angle', minu2(:, 4), ...
                   'S1', minu2(:, 5), 'S2', minu2(:, 6));
end;

[r] = size(minutiae);
temp_struct = table2struct(minutiae);

if r == 0
    temp_struct = [minu1; minu2];
else
    temp_struct = [temp_struct; minu1; minu2];
end;

minutiae = struct2table(temp_struct);

save database person minutiae

% for clearing the fields
set(handles.t_name, 'string', '');
set(handles.t_age, 'string', '');
set(handles.t_f1, 'string', '');
set(handles.t_f2, 'string', '');
set(hObject, 'String', 'Enrol to database');
drawnow();


conn = database('matlab', 'root' , ''); 
conn.Message
C = {name, 100} 
data = cell2table(C,'VariableNames',{'pname' 'rides'})
tablename = 'pdata';
sqlwrite(conn,tablename,data)
rows = sqlread(conn,tablename)
close(conn)


fprintf(['done!\n']);


function t_f1_Callback(hObject, eventdata, handles)

function t_f1_CreateFcn(hObject, eventdata, handles)

if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes on button press in b_f1.
function b_f1_Callback(hObject, eventdata, handles)
% hObject    handle to b_f1 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)
[filename1, pathname1] = ...
    uigetfile('*.tif','Select first fingerprint', ...
    'D:\8th SEMESTER\BIOMETRICS\JCOMP\Trail2\FP\Fingerprint-Recognition-Matlab-master\src\FVC2002\DB1_B');
set(handles.t_f1, 'string', [pathname1 filename1]);





function t_f2_Callback(hObject, eventdata, handles)
% hObject    handle to t_f2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

% Hints: get(hObject,'String') returns contents of t_f2 as text
%        str2double(get(hObject,'String')) returns contents of t_f2 as a double


% --- Executes during object creation, after setting all properties.
function t_f2_CreateFcn(hObject, eventdata, handles)
% hObject    handle to t_f2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    empty - handles not created until after all CreateFcns called

% Hint: edit controls usually have a white background on Windows.
%       See ISPC and COMPUTER.
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end


% --- Executes on button press in b_f2.
function b_f2_Callback(hObject, eventdata, handles)
% hObject    handle to b_f2 (see GCBO)
% eventdata  reserved - to be defined in a future version of MATLAB
% handles    structure with handles and user data (see GUIDATA)

[filename2, pathname2] = ...
    uigetfile('*.tif','Select second fingerprint', ...
    'D:\8th SEMESTER\BIOMETRICS\JCOMP\Trail2\FP\Fingerprint-Recognition-Matlab-master\src\FVC2002\DB1_B');
set(handles.t_f2, 'string', [pathname2 filename2]);
