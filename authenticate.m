function varargout = authenticate(varargin)
gui_Singleton = 1;
gui_State = struct('gui_Name',       mfilename, ...
                   'gui_Singleton',  gui_Singleton, ...
                   'gui_OpeningFcn', @authenticate_OpeningFcn, ...
                   'gui_OutputFcn',  @authenticate_OutputFcn, ...
                   'gui_LayoutFcn',  [], ...
                   'gui_Callback',   []);
if nargin && ischar(varargin{1})
   gui_State.gui_Callback = str2func(varargin{1});
end

if nargout
    [varargout{1:nargout}] = gui_mainfcn(gui_State, varargin{:});
else
    gui_mainfcn(gui_State, varargin{:});
end
function authenticate_OpeningFcn(hObject, eventdata, handles, varargin)
handles.output = hObject;
guidata(hObject, handles);
function varargout = authenticate_OutputFcn(hObject, eventdata, handles)
varargout{1} = handles.output;
function t_f_Callback(hObject, eventdata, handles)
function t_f_CreateFcn(hObject, eventdata, handles)
if ispc && isequal(get(hObject,'BackgroundColor'), get(0,'defaultUicontrolBackgroundColor'))
    set(hObject,'BackgroundColor','white');
end
function b_f_Callback(hObject, eventdata, handles)
[filename2, pathname2] = ...
    uigetfile('*.tif','Select second fingerprint', ...
    'D:\8th SEMESTER\BIOMETRICS\JCOMP\Trail2\FP\Fingerprint-Recognition-Matlab-master\src\FVC2002\DB1_B');
set(handles.t_f, 'string', [pathname2 filename2]);

function b_authenticate_Callback(hObject, eventdata, handles)
set(handles.t_header, 'string', '');
drawnow();
path = get(handles.t_f, 'string');
img1 = imread(path);
imshow(img1);title('Input');
fprintf(['>> Beginning extraction process\n']);
set(hObject, 'string', 'Extracting minutiae...');
drawnow();
inp_minutiae = ext_finger(img1, 1);
fprintf(['done!\n']);
fprintf(['>> Comparing against database... ']);
set(hObject, 'string', 'Comparing against database... ');
drawnow();
load database person minutiae
uniq = unique(minutiae(:, 1));
r = size(uniq(:, :));
k = size(minutiae(:, :));
uniq = table2struct(uniq);
uniq = struct2cell(uniq);
first = minutiae(:, 1);
first = table2struct(first);
first = struct2cell(first);
s = 0;

for i=1:r
    temp_struct = struct('X', [], 'Y', [], 'Type', [], 'Angle', [],'S1', [], 'S2', []);
    for j=1:k
        % build temporary structure of minutiae pertaining to a fingerprint
        if strcmp(uniq(i), first(j))
            p = size(temp_struct);
            if p==0
                temp_struct = table2struct(minutiae(j, 2:7));
            else
                temp_struct = [temp_struct; table2struct(minutiae(j, 2:7))];
            end;
        end;
    end;
        
    % getting match score
    temp_struct = transpose(cell2mat(struct2cell(temp_struct)));
    if s==0
        s = match(inp_minutiae, temp_struct);
    else
        s = horzcat(s, match(inp_minutiae, temp_struct));
    end;
        
end;

maxim = max(s);
len = length(s);
for i=1:len
    if s(i)==maxim
        break;
    end;
end;

if (maxim<0.48) 
    fprintf(['>> No match found for given fingerprint.\n']);
    set(handles.t_header, 'string', 'No match found.');
    drawnow();
else
    x = round(i/2);
    name = char(struct2cell(table2struct(person(x, 1))));

 
    set(handles.t_header, 'string', ['Hello ' name]);
    
    
    conn = database('matlab', 'root' , ''); 
    conn.Message
    date = datestr(now,'yyyy-mm-dd HH:MM:SS');
    C = {name, date};
    data = cell2table(C,'VariableNames',{'rname' 'time'})
    tablename = 'ridehistory';
    sqlwrite(conn,tablename,data)
    close(conn)
    
    
    drawnow();
    
end;

set(hObject, 'string', 'Authenticate');


% --- Executes during object creation, after setting all properties.
function axes1_CreateFcn(hObject, eventdata, handles)
